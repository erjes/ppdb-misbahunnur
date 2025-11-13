<?php

namespace App\Livewire\Admin\Registration;

use App\Models\Student;
use App\Models\Registration;
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
    public $newStatus; 

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

    public function updateStatus()
    {
        if (!in_array($this->newStatus, ['approved', 'rejected', 'pending'])) {
            session()->flash('error', 'Status yang dipilih tidak valid.');
            return;
        }

        $this->registration->status = $this->newStatus;
        $this->registration->save();

        $this->loadData();

        session()->flash('message', 'Status pendaftaran berhasil diupdate!');
    }

    public function render()
    {
        return view('livewire.admin.registration.details', [
            'student' => $this->student,
            'registration' => $this->registration,
            'fees' => $this->fees,
            'payments' => $this->payments,
        ]);
    }
}
