<?php

namespace App\Livewire\Student\Payment;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Payment;
use App\Models\Student;
use App\Models\Fees;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')] 
class PaymentComponent extends Component
{
    use WithFileUploads;

    public $paymentProof; 
    public $studentId;     
    public $student;        
    public $jenis_dokumen = 'Bukti Pembayaran'; 

    public $feeId = 1;

    protected $rules = [
        'paymentProof' => 'required|mimes:jpg,jpeg,png,pdf|max:2048', 
    ];

    public function mount($studentId)
    {
        $this->student   = Student::where('id', $studentId)->firstOrFail();
        $this->studentId = $this->student->id;
    }

    public function submitPaymentProof()
    {
        $this->validate();

        $fee = Fees::findOrFail($this->feeId);

        $fileName = time().'_'.$this->paymentProof->getClientOriginalName();
        $folder   = 'payments/'.$this->studentId;

        $this->paymentProof->storeAs(
            $folder,
            $fileName,
            'private'
        );

        $payment = new Payment();
        $payment->fee_id           = $fee->id;
        $payment->jumlah           = $fee->jumlah;      
        $payment->student_id       = $this->studentId;
        $payment->bukti_pembayaran = $fileName;
        $payment->tanggal_bayar    = now();
        $payment->verifikasi       = 0;
        $payment->save();

        session()->flash('message', 'Bukti pembayaran berhasil dikirim! Menunggu verifikasi.');

        $this->reset(['paymentProof']);
    }

    public function render()
    {
        return view('livewire.payment.upload', [
            'student' => $this->student,
        ]);
    }
}
