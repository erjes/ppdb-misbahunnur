<?php

namespace App\Livewire\Admin\Payment;

use Livewire\Component;
use App\Models\Payment;

class PaymentVerificationComponent extends Component
{
    public $payment;
    public $isPaid;

    public function mount($paymentId)
    {
        $this->payment = Payment::findOrFail($paymentId);
        $this->isPaid = $this->payment->is_paid;
    }

    public function updatePaymentStatus()
    {
        $this->payment->is_paid = $this->isPaid;
        $this->payment->save();

        session()->flash('message', 'Status pembayaran berhasil diperbarui.');
    }

    public function render()
    {
        return view('livewire.admin.payment.verification');
    }
}
