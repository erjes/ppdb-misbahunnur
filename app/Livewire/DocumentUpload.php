<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Document;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]

class DocumentUpload extends Component
{
    use WithFileUploads;

    // Properti untuk menyimpan file upload
    public $akta_kelahiran;
    public $kartu_keluarga;
    public $ktp_ortu;
    public $nisn_skhun;
    public $ijazah;
    public $rapor;
    public $pas_foto;
    public $surat_aktif_sekolah;
    
    // Properti opsional untuk No. Dokumen
    public $no_nisn_skhun;
    public $no_ijazah;

    // Aturan validasi dasar
    protected $rules = [
        'akta_kelahiran' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120', // Maks 5MB
        'kartu_keluarga' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'ktp_ortu' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'nisn_skhun' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'ijazah' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'rapor' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'pas_foto' => 'nullable|file|mimes:jpg,jpeg,png|max:2048', // Maks 2MB
        'surat_aktif_sekolah' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',

        'no_nisn_skhun' => 'nullable|string|max:50',
        'no_ijazah' => 'nullable|string|max:50',
    ];

    public function saveDocuments()
    {
        // Jalankan validasi
        $this->validate();

        // Asumsikan user_id (student_id) diambil dari user yang sedang login
        $studentId = Student::where('user_id', Auth::id())->value('id');

        if (!$studentId) {
            session()->flash('message', 'Data siswa tidak ditemukan untuk akun ini.');
            return;
        }

        
        // Daftar dokumen yang diupload
        $uploads = [
            'Akta Kelahiran' => ['file' => $this->akta_kelahiran, 'no' => null],
            'Kartu Keluarga' => ['file' => $this->kartu_keluarga, 'no' => null],
            'KTP Ortu/Calon Santri' => ['file' => $this->ktp_ortu, 'no' => null],
            'NISN & SKHUN' => ['file' => $this->nisn_skhun, 'no' => $this->no_nisn_skhun],
            'Ijazah' => ['file' => $this->ijazah, 'no' => $this->no_ijazah],
            'Rapor kelas 5-9' => ['file' => $this->rapor, 'no' => null],
            'Pas Foto 3x4' => ['file' => $this->pas_foto, 'no' => null],
            'Surat Keterangan Aktif Sekolah' => ['file' => $this->surat_aktif_sekolah, 'no' => null],
        ];

        foreach ($uploads as $jenis => $data) {
            if ($data['file']) {
                // Simpan file ke storage dan dapatkan path
                $path = $data['file']->store('public/documents/' . $studentId);

                // Hapus dokumen lama jika ada (logika update)

                Document::updateOrCreate(
                    [
                        'student_id' => $studentId, 
                        'jenis_dokumen' => $jenis
                    ],
                    [
                        'no_dokumen' => $data['no'],
                        'file_path' => $path,
                    ]
                );
            }
        }

        session()->flash('message', 'Dokumen berhasil diunggah dan disimpan!');
    }

    public function render()
    {
        return view('livewire.document-upload');
    }
}