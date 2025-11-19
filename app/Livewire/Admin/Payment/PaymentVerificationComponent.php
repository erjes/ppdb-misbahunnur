<?php

namespace App\Livewire\Admin\Payment;

use Livewire\Component;
use App\Models\Payment;
use App\Models\Registration;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')] 

class PaymentVerificationComponent extends Component
{
    public $payment;
    public $registration;
    public $verifikasi;

    public function mount($studentId)
    {
        $this->payment = Payment::where('student_id', $studentId)
        ->latest()
        ->firstOrFail();

        $this->registration = Registration::where('student_id', $studentId)
        ->firstOrFail();
        $this->verifikasi = $this->payment->verifikasi; 
    }

    public function updatePaymentStatus()
    {
        $this->payment->verifikasi = $this->verifikasi;
        $this->payment->save(); 

        $this->registration->is_paid = $this->verifikasi;  
        $this->registration->save();  

        session()->flash('message', 'Status pembayaran berhasil diperbarui.');
    }

    public function render()
    {
        return view('livewire.admin.payment.verification');
    }
}
