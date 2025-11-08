<?php
namespace App\Livewire\Student\Registration;

use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

                // Now assign the data to class variables
                $this->addressData = [
                    'alamat_lengkap' => $submissionData['alamat'] ?? 'Tidak tersedia',
                    'provinsi' => $submissionData['provinsi'] ?? 'Tidak tersedia',
                ];
        
                $this->parentData = [
                    'ayah' => [
                        'nama_lengkap' => $submissionData['nama_ayah'] ?? 'Tidak tersedia',
                    ],
                    'ibu' => [
                        'nama_lengkap' => $submissionData['nama_ibu'] ?? 'Tidak tersedia',
                    ],
                ];
        
                $this->schoolData = [
                    'nama' => $submissionData['nama_sekolah'] ?? 'Tidak tersedia',
                    'npsn' => $submissionData['npsn_sekolah'] ?? 'Tidak tersedia',
                    'jenjang' => $submissionData['jenjang_daftar'] ?? 'Tidak tersedia',
                ];
            } else {
                // Handle the case where submission_data is not valid
                $this->addressData = [
                    'alamat_lengkap' => 'Tidak tersedia',
                    'provinsi' => 'Tidak tersedia',
                ];
        
                $this->parentData = [
                    'ayah' => ['nama_lengkap' => 'Tidak tersedia'],
                    'ibu' => ['nama_lengkap' => 'Tidak tersedia'],
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
            
            // Clean all data before passing to PDF
            $cleanedData = $this->cleanDataForPdf([
                'student' => $this->student,
                'registration' => $this->registration,
                'addressData' => $this->addressData,
                'parentData' => $this->parentData,
                'schoolData' => $this->schoolData,
            ]);
    
            $pdf = PDF::loadView('pdf.registration_approved', $cleanedData);
            
            return response()->streamDownload(
                function () use ($pdf) {
                    echo $pdf->stream();
                },
                'surat_pengumuman_ppdb.pdf'
            );
        }
    
        session()->flash('error', 'Pendaftaran tidak disetujui untuk ekspor.');
    }
    
    private function cleanDataForPdf($data)
    {
        array_walk_recursive($data, function (&$value, $key) {
            if (is_string($value)) {
                // Remove invalid UTF-8 characters
                $value = mb_convert_encoding($value, 'UTF-8', 'UTF-8');
                $value = preg_replace('/[^\x{0009}\x{000A}\x{000D}\x{0020}-\x{D7FF}\x{E000}-\x{FFFD}]+/u', '', $value);
                
                // Alternative: Use iconv for more aggressive cleaning
                $value = iconv('UTF-8', 'UTF-8//IGNORE', $value);
                
                // Trim and ensure it's not empty
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
