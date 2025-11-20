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
    public $signature_image, $stamp_image, $existing_signature, $existing_stamp;

    public $p2_opening;
    public $p2_conditional;
    public $p2_requirements;
    public $p2_payment_terms;
    public $p2_resign_intro;
    public $p2_resign_points;
    public $p2_closing;
    public $p2_footer_note;

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
            $this->existing_signature = $setting->signature_path;
            $this->existing_stamp = $setting->stamp_path;

            $this->p2_opening = $setting->p2_opening;
            $this->p2_conditional = $setting->p2_conditional;
            $this->p2_requirements = $setting->p2_requirements;
            $this->p2_payment_terms = $setting->p2_payment_terms;
            $this->p2_resign_intro = $setting->p2_resign_intro;
            $this->p2_resign_points = $setting->p2_resign_points;
            $this->p2_closing = $setting->p2_closing;
            $this->p2_footer_note = $setting->p2_footer_note;
        } else {
            $this->setDefaultValues();
        }
    }

    private function setDefaultValues()
    {
        $this->date = date('d F Y');
        $this->school_year = '2024-2025';
        $this->sk_number = '01/PAN-PPDB/SK/XII/2025';
        $this->signer_name = 'Ustadz Furqon';
        $this->signer_title = 'Ketua Panitia PPDB PPTQ Misbahunnur';
        
        $this->p2_opening = "Diberitahukan kepada seluruh orang tua calon santri Pondok Pesantren Tahfizh Al-Qur'an (PPTQ) Misbahunnur Tahun Pelajaran [TAHUN] bahwa:";
        
        $this->p2_conditional = "Calon Santri PPTQ Misbahunnur TP. [TAHUN] yang telah dinyatakan lulus dalam tes Gelombang I bisa diterima sebagai santri PPTQ Misbahunnur TP. [TAHUN] secara resmi apabila:";

        $this->p2_requirements = "Melengkapi data/persyaratan pendaftaran Bagi yang belum diserahkan (Fotocopy KTP orangtua, Akta Kelahiran, Kartu Keluarga, dan Kartu NISN. Sementara untuk fotocopi Ijazah dan SKHUS bisa menyusul);";

        $this->p2_payment_terms = "Pembayaran DSP dibayarkan minimal 50% dari total DSP yang wajib dibayarkan.\nWaktu pembayaran mulai tanggal 15 Desember 2023 sampai 15 Januari 2024 sebagai pembayaran tahap I;\nAdministrasi DSP secara keseluruhan harus lunas tanggal 16 Januari 2024 sampai 31 Mei 2024 sebagai pembayaran tahap II;\nUntuk Kedatangan Santri akan kami beritahukan pada pengumuman selanjutnya di group gelombang 1.";

        $this->p2_resign_intro = "Berikut adalah hal-hal yang berkaitan dengan pengunduran diri :";

        $this->p2_resign_points = "Calon santri yang belum ada pembayaran tahap I sampai 16 Januari 2024 dinyatakan mengundurkan diri;\nBagi calon santri yang langsung melunasi DSP ada potongan 15% dari Uang Pembangunan.\nCalon santri yang mengundurkan diri sebelum tahun Pelajaran [TAHUN] dimulai, maka uang DSP dikembalikan sebesar 100% dari yang telah dibayarkan;\nSantri yang mengundurkan diri setelah dimulainya kegiatan tidak ada pengembalian uang DSP.\nSantri yang dikeluarkan (karena melanggar aturan pesantren) setelah dimulainya kegiatan tidak ada pengembalian uang DSP.";

        $this->p2_closing = "Demikian surat pemberitahuan ini kami sampaikan. Atas perhatian dan kerjasamanya kami haturkan terima kasih. Teriring Jazakumullah khairan katsiiran.";

        $this->p2_footer_note = "Nb. Pembayaran DSP bisa langsung ke Kantor PPTQ Misbahunnur atau melalui Bank Syariah Indonesia (BSI) No. Rek. 1056613702 (kode Bank 451) an. Yayasan Misbahunnur dengan menyertakan nama orang tua dan nama calon santri dan memberikan informasinya ke bagian keuangan PPTQ Misbahunnur.\nHub. WA 0812 8484 8495 (Admin Keuangan)";
    }

    public function saveSettings()
    {
        $data = [
            'sk_number' => $this->sk_number,
            'date_string' => $this->date,
            'school_year' => $this->school_year,
            'signer_name' => $this->signer_name,
            'signer_title' => $this->signer_title,
            'menimbang' => $this->content_menimbang,
            'memperhatikan' => $this->content_memperhatikan,
            
            'p2_opening' => $this->p2_opening,
            'p2_conditional' => $this->p2_conditional,
            'p2_requirements' => $this->p2_requirements,
            'p2_payment_terms' => $this->p2_payment_terms,
            'p2_resign_intro' => $this->p2_resign_intro,
            'p2_resign_points' => $this->p2_resign_points,
            'p2_closing' => $this->p2_closing,
            'p2_footer_note' => $this->p2_footer_note,
        ];

        if ($this->signature_image) {
            $data['signature_path'] = $this->signature_image->store('public/letters');
        }
        if ($this->stamp_image) {
            $data['stamp_path'] = $this->stamp_image->store('public/letters');
        }

        LetterSetting::updateOrCreate(['id' => 1], $data);
        session()->flash('message', 'Pengaturan surat halaman 1 & 2 berhasil disimpan.');
    }

    public function render()
    {
        return view('livewire.admin.pdf.letter');
    }
}