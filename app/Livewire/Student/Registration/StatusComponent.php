<?php
namespace App\Livewire\Student\Registration;

use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\LetterSetting;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]

class StatusComponent extends Component
{
    public $student;
    public $registration;
    public $addressData = [];
    public $parentData = [];
    public $schoolData = [];

    public function mount()
    {
        $this->loadData();
    }

    private function loadData()
    {
        $user = Auth::user();
        
        $studentData = DB::table('students')
            ->join('registrations', 'students.id', '=', 'registrations.student_id')
            ->leftJoin('form_submissions', 'students.id', '=', 'form_submissions.student_id')
            ->select(
                'students.*',
                'registrations.*',
                'form_submissions.submission_data',
            )
            ->where('students.user_id', $user->id)
            ->first();
        
        if ($studentData) {
            $this->student = $studentData;
            $this->registration = $studentData;
        
            // Decode the submission_data JSON field
            $submissionData = json_decode($studentData->submission_data, true);
            
            // Check if json_decode returned an array
            if (is_array($submissionData)) {
                // Ensure UTF-8 encoding for all string values in submission_data
                $submissionData = array_map(function ($value) {
                    return is_string($value) ? mb_convert_encoding($value, 'UTF-8', 'UTF-8') : $value;
                }, $submissionData);
    
                // Remove any invalid UTF-8 characters that could cause issues
                $submissionData = array_map(function ($value) {
                    return is_string($value) ? preg_replace('/[^\x20-\x7E]/', '', $value) : $value;
                }, $submissionData);
    
                // Ensure parent data is loaded properly
                $this->addressData = [
                    'alamat_lengkap' => $submissionData['alamat'] ?? 'Tidak tersedia',
                    'provinsi' => $submissionData['provinsi'] ?? 'Tidak tersedia',
                ];
    
                $this->parentData = [
                    'nama_ayah' => $submissionData['nama_ayah'] ?? $studentData->nama_ayah ?? 'Tidak tersedia',
                    'nama_ibu' => $submissionData['nama_ibu'] ?? $studentData->nama_ibu ?? 'Tidak tersedia',
                ];
    
                $this->schoolData = [
                    'nama' => $submissionData['nama_sekolah'] ?? 'Tidak tersedia',
                    'npsn' => $submissionData['npsn_sekolah'] ?? 'Tidak tersedia',
                    'jenjang' => $submissionData['jenjang_daftar'] ?? 'Tidak tersedia',
                ];
            } else {
                $this->addressData = [
                    'alamat_lengkap' => 'Tidak tersedia',
                    'provinsi' => 'Tidak tersedia',
                ];
    
                $this->parentData = [
                    'nama_ayah' => $studentData->nama_ayah ?? 'Tidak tersedia',
                    'nama_ibu' => $studentData->nama_ibu ?? 'Tidak tersedia',
                ];
    
                $this->schoolData = [
                    'nama' => 'Tidak tersedia',
                    'npsn' => 'Tidak tersedia',
                    'jenjang' => 'Tidak tersedia',
                ];
            }
        }
    }
 
    public function exportApprovedRegistration()
    {
        if ($this->registration && $this->registration->status == 'approved') {
            
            $studentData = $this->cleanDataForPdf([
                'student' => $this->student,
                'registration' => $this->registration,
                'addressData' => $this->addressData,
                'parentData' => $this->parentData,
                'schoolData' => $this->schoolData,
            ]);

            $letterSetting = LetterSetting::first();

            $letterData = [
                'sk_number' => '...',
                'date' => date('d F Y'),
                'school_year' => date('Y').'-'.(date('Y')+1),
                'signer_name' => 'Panitia',
                'signer_title' => 'Ketua Panitia',
                'menimbang' => [],
                'memperhatikan' => [],
                'payment_deadline_1_start' => '-',
                'payment_deadline_1_end' => '-',
                'payment_deadline_2_end' => '-',
                'bank_account_info' => '-',
                'signature' => null,
                'stamp' => null,
                'city' => 'Cimahi' 
            ];

            if ($letterSetting) {
                $sigPath = $letterSetting->signature_path ? public_path('storage/' . str_replace('public/', '', $letterSetting->signature_path)) : null;
                $stampPath = $letterSetting->stamp_path ? public_path('storage/' . str_replace('public/', '', $letterSetting->stamp_path)) : null;

                $letterData = [
                    'sk_number' => $letterSetting->sk_number,
                    'date' => $letterSetting->date_string,
                    'school_year' => $letterSetting->school_year,
                    'signer_name' => $letterSetting->signer_name,
                    'signer_title' => $letterSetting->signer_title,
                    'menimbang' => explode("\n", $letterSetting->menimbang), 
                    'memperhatikan' => explode("\n", $letterSetting->memperhatikan),
                    'payment_deadline_1_start' => $letterSetting->payment_start,
                    'payment_deadline_1_end' => $letterSetting->payment_end_1,
                    'payment_deadline_2_end' => $letterSetting->payment_end_2,
                    'bank_account_info' => $letterSetting->bank_info,
                    'signature' => $sigPath,
                    'stamp' => $stampPath,
                    'city' => 'Cimahi'
                ];
            }

            $finalData = array_merge($studentData, $letterData);

            $pdf = PDF::loadView('pdf.registration_approved', $finalData);
            $pdf->setPaper('a4', 'portrait'); 
            
            return response()->streamDownload(
                function () use ($pdf) {
                    echo $pdf->output();
                },
                'Surat_Keputusan_' . preg_replace('/[^A-Za-z0-9\-]/', '', $this->student->name ?? 'Siswa') . '.pdf'
            );
        }
    
        session()->flash('error', 'Pendaftaran tidak disetujui untuk ekspor.');
    }
    
    private function cleanDataForPdf($data)
    {
        array_walk_recursive($data, function (&$value, $key) {
            if (is_string($value)) {
                $value = mb_convert_encoding($value, 'UTF-8', 'UTF-8');
                $value = preg_replace('/[^\x{0009}\x{000A}\x{000D}\x{0020}-\x{D7FF}\x{E000}-\x{FFFD}]+/u', '', $value);
                
                $value = iconv('UTF-8', 'UTF-8//IGNORE', $value);
                
                $value = trim($value);
                if (empty($value)) {
                    $value = 'Tidak tersedia';
                }
            }
        });
        
        return $data;
    }
    

    public function render()
    {
        return view('livewire.registration.status');
    }
}
