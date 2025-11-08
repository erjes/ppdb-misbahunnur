<?php

namespace App\Livewire\Student\Registration;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Document;
use App\Models\Student;
use App\Models\Registration;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]

class DocumentComponent extends Component
{
    use WithFileUploads;

    public $akta_kelahiran;
    public $kartu_keluarga;
    public $ktp_ortu;
    public $nisn_skhun;
    public $ijazah;
    public $rapor;
    public $pas_foto;
    public $surat_aktif_sekolah;
    
    public $surat_kematian_ortu;
    public $surat_keterangan_tdk_mampu;
    public $sertifikat_tambahan; 

    public $no_nisn_skhun;
    public $no_ijazah;

    public $jalurDaftar = 'Reguler'; 
    
    // --- RULES & MOUNTING ---
    
    protected $baseRules = [
        'akta_kelahiran' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048', 
        'kartu_keluarga' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'ktp_ortu' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'nisn_skhun' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'ijazah' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'rapor' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'pas_foto' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
        'surat_aktif_sekolah' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',

        'no_nisn_skhun' => 'nullable|string|max:50',
        'no_ijazah' => 'nullable|string|max:50',
        
        'surat_kematian_ortu' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'surat_keterangan_tdk_mampu' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'sertifikat_tambahan' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120', 
    ];

    public function mount()
    {
        $studentId = Student::where('user_id', Auth::id())->value('id');

        if ($studentId) {
            $registration = Registration::where('student_id', $studentId)->first();
            
            if ($registration) {
                $this->jalurDaftar = $registration->jalur_daftar ?? 'Reguler'; 
            }
        }
    }

    public function getRules()
    {
        $rules = $this->baseRules;
        $jalur = $this->jalurDaftar;

        if ($jalur == 'Dhuafa') {
             $rules['surat_keterangan_tdk_mampu'] = 'required|file|mimes:pdf,jpg,jpeg,png|max:2048'; 
             $rules['sertifikat_tambahan'] = 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120';
        }
        
        if ($jalur == 'Yatim') { 
            $rules['surat_kematian_ortu'] = 'required|file|mimes:pdf,jpg,jpeg,png|max:2048';
            $rules['surat_keterangan_tdk_mampu'] = 'required|file|mimes:pdf,jpg,jpeg,png|max:2048';
        }
        
        if ($jalur == 'Prestasi') {
            $rules['sertifikat_tambahan'] = 'required|file|mimes:pdf,jpg,jpeg,png|max:5120';
        }
        
        return $rules;
    }

    public function rules()
    {
        return $this->getRules();
    }
    

    public function saveDocuments()
    {
        $this->validate($this->getRules());

        $student = Student::where('user_id', Auth::id())->first();

        if (!$student) {
            session()->flash('message', 'Data siswa tidak ditemukan untuk akun ini.');
            return;
        }

        $studentId = $student->id;
        
        $uploads = [
            'Akta Kelahiran' => ['prop' => 'akta_kelahiran', 'no' => null],
            'Kartu Keluarga' => ['prop' => 'kartu_keluarga', 'no' => null],
            'KTP Ortu/Calon Santri' => ['prop' => 'ktp_ortu', 'no' => null],
            'NISN & SKHUN' => ['prop' => 'nisn_skhun', 'no' => $this->no_nisn_skhun],
            'Ijazah' => ['prop' => 'ijazah', 'no' => $this->no_ijazah],
            'Rapor kelas 5-9' => ['prop' => 'rapor', 'no' => null],
            'Pas Foto 3x4' => ['prop' => 'pas_foto', 'no' => null],
            'Surat Keterangan Aktif Sekolah' => ['prop' => 'surat_aktif_sekolah', 'no' => null],
            
            'Surat Kematian Ortu/Bapak' => ['prop' => 'surat_kematian_ortu', 'no' => null],
            'Surat Ket. Tidak Mampu' => ['prop' => 'surat_keterangan_tdk_mampu', 'no' => null],
            'Sertifikat Lomba/Hafalan' => ['prop' => 'sertifikat_tambahan', 'no' => null],
        ];

        foreach ($uploads as $jenis => $data) {
            $file = $this->{$data['prop']};
            
            if ($file) {
                $path = $file->store('private/documents/' . $studentId);

                Document::updateOrCreate(
                    [
                        'student_id' => $studentId, 
                        'jenis_dokumen' => $jenis
                    ],
                    [
                        'no_dokumen' => $data['no'],
                        'file_path' => basename($path), 
                    ]
                );
            }
        }

        session()->flash('message', 'Dokumen berhasil diunggah dan disimpan!');
    }

    public function render()
    {
        return view('livewire.registration.document');
    }
}