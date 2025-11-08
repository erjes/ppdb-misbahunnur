<?php

namespace App\Livewire\Admin\Registration;

use App\Models\Student;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]  

class DetailsComponent extends Component
{
    public $nomor_pendaftaran;
    public $student;
    public $registration;
    public $fees;
    public $payments;

    public function mount($nomor_pendaftaran)
    {
        $this->nomor_pendaftaran = $nomor_pendaftaran;
        $this->loadData();
    }

    public function loadData()
    {
        $this->student = Student::where('nomor_pendaftaran', $this->nomor_pendaftaran)
            ->with(['user.payments.fees', 'user.payments'])
            ->firstOrFail();

        $this->registration = $this->student->registration;

        $this->payments = $this->student->user->payments;
        $this->fees = $this->payments->map(function ($payment) {
            return $payment->fees;
        });
    }

    public function render()
    {
        return view('livewire.admin.registration.details', [
            'student' => $this->student,
            'registration' => $this->registration,
            'fees' => $this->fees,
            'payments' => $this->payments
        ]);
    }
}
