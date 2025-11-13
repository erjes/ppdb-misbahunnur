<?php

namespace App\Livewire\Student\Payment;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Document;
use App\Models\Payment;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PaymentComponent extends Component
{
    use WithFileUploads;

    public $paymentProof; 
    public $paymentCode; 
    public $jenis_dokumen = 'Bukti Pembayaran'; 

    protected $rules = [
        'paymentProof' => 'required|mimes:jpg,jpeg,png,pdf|max:2048', 
    ];

    public function mount($paymentCode)
    {
        $this->paymentCode = $paymentCode;
    }

    public function submitPaymentProof()
    {
        $this->validate();

        $payment = Payment::find($this->paymentCode);

        if (!$payment) {
            session()->flash('error', 'Pembayaran tidak ditemukan.');
            return;
        }

        if ($payment->is_paid) {
            session()->flash('error', 'Pembayaran sudah terverifikasi!');
            return;
        }
 
        $filePath = $this->paymentProof->store('payments', 'public');

        $payment->user_id = Auth::id();
        $payment->paymentCode;
        $payment->bukti = $filePath;
        $payment->save();

        session()->flash('message', 'Bukti pembayaran berhasil dikirim! Menunggu verifikasi.');

        $this->reset(['paymentProof']);
    }

    public function render()
    {
        return view('livewire.payment.upload');
    }
}
