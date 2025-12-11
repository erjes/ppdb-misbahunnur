<?php

namespace App\Livewire\Admin\Registration;

use App\Models\Payment;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\DB;

#[Layout('layouts.app')]
class DetailsComponent extends Component
{
    public $submissionId;
    public $student;
    public $registration;
    public $payments;
    public $newStatus;

    public function mount($studentId)
    {
        $this->submissionId = $studentId;
        $this->loadData();
    }

    public function loadData()
    {
        $submission = DB::table('form_submissions')
            ->where('student_id', $this->submissionId)
            ->first();

        if (!$submission) {
            abort(404);
        }

        $data = json_decode($submission->submission_data, true);

        if (is_string($data)) {
            $data = json_decode($data, true);
        }

        if (!is_array($data)) {
            $data = []; 
        }

        $mappedData = $data;

        $mappedData['registration'] = (object) [
            'jalur_daftar' => $data['jalur_daftar'] ?? '-',
            'jenjang_daftar' => $data['jenjang_daftar'] ?? '-',
            'status' => $submission->status ?? ($data['status'] ?? 'pending'),
            'tanggal_daftar' => $submission->created_at ?? now(),
            'gelombang' => $data['gelombang'] ?? '1',
        ];


        $this->student = json_decode(json_encode($mappedData));

        $this->registration = $this->student->registration;

        $this->payments = Payment::where('student_id', $this->submissionId)
            ->get();

        $this->newStatus = $this->registration->status;
    }

    public function render()
    {
        return view('livewire.admin.registration.details', [
            'studentId' => $this->submissionId,
            'student' => $this->student,
            'registration' => $this->registration,
            'payments' => $this->payments,
        ]);
    }
}
