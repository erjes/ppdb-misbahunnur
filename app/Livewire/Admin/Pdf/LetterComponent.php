<?php

namespace App\Livewire\Admin\Pdf;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\LetterSetting; 
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]

class LetterComponent extends Component
{
    use WithFileUploads;

    public $sk_number, $date, $school_year;
    public $signer_name, $signer_title;
    public $content_menimbang, $content_memperhatikan;
    public $payment_deadline_1_start, $payment_deadline_1_end, $payment_deadline_2_end;
    public $bank_account_info;
    
    public $signature_image, $stamp_image;
    
    public $existing_signature, $existing_stamp;

    public function mount()
    {
        $setting = LetterSetting::first();

        if ($setting) {
            $this->sk_number = $setting->sk_number;
            $this->date = $setting->date_string;
            $this->school_year = $setting->school_year;
            $this->signer_name = $setting->signer_name;
            $this->signer_title = $setting->signer_title;
            $this->content_menimbang = $setting->menimbang;
            $this->content_memperhatikan = $setting->memperhatikan;
            $this->payment_deadline_1_start = $setting->payment_start;
            $this->payment_deadline_1_end = $setting->payment_end_1;
            $this->payment_deadline_2_end = $setting->payment_end_2;
            $this->bank_account_info = $setting->bank_info;
            $this->existing_signature = $setting->signature_path;
            $this->existing_stamp = $setting->stamp_path;
        } else {
            $this->date = date('d F Y');
            $this->sk_number = '01/PAN-PPDB/SK/XII/2023';
        }
    }

    public function saveSettings()
    {
        $this->validate([
            'sk_number' => 'required',
            'signer_name' => 'required',
        ]);

        $data = [
            'sk_number' => $this->sk_number,
            'date_string' => $this->date,
            'school_year' => $this->school_year,
            'signer_name' => $this->signer_name,
            'signer_title' => $this->signer_title,
            'menimbang' => $this->content_menimbang,
            'memperhatikan' => $this->content_memperhatikan,
            'payment_start' => $this->payment_deadline_1_start,
            'payment_end_1' => $this->payment_deadline_1_end,
            'payment_end_2' => $this->payment_deadline_2_end,
            'bank_info' => $this->bank_account_info,
        ];

        if ($this->signature_image) {
            $data['signature_path'] = $this->signature_image->store('public/letters');
        }
        
        if ($this->stamp_image) {
            $data['stamp_path'] = $this->stamp_image->store('public/letters');
        }

        LetterSetting::updateOrCreate(['id' => 1], $data);

        session()->flash('message', 'Pengaturan surat berhasil disimpan.');
    }

    public function render()
    {
        return view('livewire.admin.pdf.letter');
    }
}