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

        private function cleanDataForPdf($data)
        {
            $cleanedData = [];
            foreach ($data as $key => $value) {
                if (is_string($value)) {
                    $cleanedData[$key] = preg_replace('/[^\x20-\x7E]/', '', $value);
                } else {
                    $cleanedData[$key] = $value;
                }
            }
            return $cleanedData;
        }
    public function exportApprovedRegistration()
    {
        if ($this->registration && $this->registration->status == 'approved') {
            
            // 1. Bersihkan Data Siswa
            $studentData = $this->cleanDataForPdf([
                'student' => $this->student,
                'registration' => $this->registration,
                'addressData' => $this->addressData,
                'parentData' => $this->parentData,
                'schoolData' => $this->schoolData,
            ]);

            // 2. Ambil Setting dari Database
            $setting = LetterSetting::first(); 

            $letterData = [
                'sk_number' => '...',
                'date' => date('d F Y'),
                'school_year' => date('Y').'-'.(date('Y')+1),
                'signer_name' => 'Panitia',
                'signer_title' => 'Ketua Panitia',
                'menimbang' => [],
                'memperhatikan' => [],
                'signature' => null,
                'stamp' => null,
                'city' => 'Cimahi',
                
                // Default Halaman 2 (Kosong)
                'p2_opening' => '',
                'p2_conditional' => '',
                'p2_requirements' => [],
                'p2_payment_terms' => [],
                'p2_resign_intro' => '',
                'p2_resign_points' => [],
                'p2_closing' => '',
                'p2_footer_note' => '',
            ];

            // 4. Override dengan Data Database jika ada
            if ($setting) {
                $replaceVars = function($text) use ($setting) {
                    return str_replace('[TAHUN]', $setting->school_year, $text ?? '');
                };

                $sigPath = $setting->signature_path ? public_path('storage/' . str_replace('public/', '', $setting->signature_path)) : null;
                $stampPath = $setting->stamp_path ? public_path('storage/' . str_replace('public/', '', $setting->stamp_path)) : null;

                $letterData = [
                    // Page 1
                    'sk_number' => $setting->sk_number,
                    'date' => $setting->date_string,
                    'school_year' => $setting->school_year,
                    'signer_name' => $setting->signer_name,
                    'signer_title' => $setting->signer_title,
                    'menimbang' => explode("\n", $setting->menimbang),
                    'memperhatikan' => explode("\n", $setting->memperhatikan),
                    'signature' => $sigPath,
                    'stamp' => $stampPath,
                    'city' => 'Cimahi', 

                    // Page 2
                    'p2_opening' => $replaceVars($setting->p2_opening),
                    'p2_conditional' => $replaceVars($setting->p2_conditional),
                    'p2_requirements' => explode("\n", $setting->p2_requirements),
                    'p2_payment_terms' => explode("\n", $setting->p2_payment_terms),
                    'p2_resign_intro' => $setting->p2_resign_intro,
                    'p2_resign_points' => explode("\n", $setting->p2_resign_points),
                    'p2_closing' => $setting->p2_closing,
                    'p2_footer_note' => nl2br($replaceVars($setting->p2_footer_note)),
                ];
            }

            // 5. Gabungkan Data
            $finalData = array_merge($studentData, $letterData);

            // 6. Generate PDF
            $pdf = PDF::loadView('pdf.registration_approved', $finalData);
            $pdf->setPaper('a4', 'portrait'); 
            
            // Ambil nama aman (cek 'nama' atau 'name')
            $safeName = $this->student->nama ?? $this->student->name ?? 'Siswa';

            return response()->streamDownload(
                function () use ($pdf) {
                    echo $pdf->output();
                },
                'Surat_Keputusan_' . preg_replace('/[^A-Za-z0-9\-]/', '', $safeName) . '.pdf'
            );
        }

        session()->flash('error', 'Pendaftaran tidak disetujui untuk ekspor.');
    }

    public function render()
    {
        return view('livewire.registration.status');
    }
}
