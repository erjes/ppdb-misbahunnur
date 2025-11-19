<?php

namespace App\Livewire\Admin\Registration;

use App\Models\Student;
use App\Models\Registration;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]  
class DetailsComponent extends Component
{
    public $studentId;
    public $student;
    public $registration;
    public $fees;
    public $payments;
    public $newStatus; 

    public function mount($studentId)
    {
        $this->studentId = $studentId;
        $this->loadData();
    }

    public function loadData()
    {

        $this->student = Student::with(['registration', 'payments.fee'])
            ->where('id', $this->studentId)   
            ->firstOrFail();

        $this->registration = $this->student->registration;
        $this->payments     = $this->student->payments;

        $this->fees = $this->payments->map(function ($payment) {
            return $payment->fee;
        });

        $this->newStatus = $this->registration->status;
    }

    public function render()
    {
        return view('livewire.admin.registration.details', [
            'student'      => $this->student,
            'registration' => $this->registration,
            'fees'         => $this->fees,
            'payments'     => $this->payments,
        ]);
    }
}
