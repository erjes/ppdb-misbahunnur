<?php

namespace App\Livewire\Student\Registration;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Document;
use App\Models\Student;
use App\Models\Registration;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
    public $studentId; 
    public $existingDocuments = [];

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
        $this->studentId = Student::where('user_id', Auth::id())->value('id');

        if ($this->studentId) {
            $registration = Registration::where('student_id', $this->studentId)->first();
            
            if ($registration) {
                $this->jalurDaftar = $registration->jalur_daftar ?? 'Reguler'; 
            }
            
            $this->loadExistingDocuments();
        }
    }

    public function loadExistingDocuments()
    {
        $docs = Document::where('student_id', $this->studentId)->get();
        
        foreach ($docs as $doc) {
            $this->existingDocuments[$doc->jenis_dokumen] = [
                'path' => $doc->file_path, 
                'no'   => $doc->no_dokumen
            ];
            
            if ($doc->jenis_dokumen == 'NISN & SKHUN') $this->no_nisn_skhun = $doc->no_dokumen;
            if ($doc->jenis_dokumen == 'Ijazah') $this->no_ijazah = $doc->no_dokumen;
        }
    }

    public function getRules()
    {
        $rules = $this->baseRules;
        $jalur = $this->jalurDaftar;

        
        $hasSktm = isset($this->existingDocuments['Surat Ket. Tidak Mampu']);
        $hasSertif = isset($this->existingDocuments['Sertifikat Lomba/Hafalan']);
        $hasSuratKematian = isset($this->existingDocuments['Surat Kematian Ortu/Bapak']);

        if ($jalur == 'Dhuafa') {
             $rules['surat_keterangan_tdk_mampu'] = $hasSktm ? 'nullable|file|...' : 'required|file|mimes:pdf,jpg,jpeg,png|max:2048'; 
             $rules['sertifikat_tambahan'] = 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120';
        }
        
        if ($jalur == 'Yatim') { 
            $rules['surat_kematian_ortu'] = $hasSuratKematian ? 'nullable|file|...' : 'required|file|mimes:pdf,jpg,jpeg,png|max:2048';
            $rules['surat_keterangan_tdk_mampu'] = $hasSktm ? 'nullable|file|...' : 'required|file|mimes:pdf,jpg,jpeg,png|max:2048';
        }
        
        if ($jalur == 'Prestasi') {
            $rules['sertifikat_tambahan'] = $hasSertif ? 'nullable|file|...' : 'required|file|mimes:pdf,jpg,jpeg,png|max:5120';
        }
        
        return $rules;
    }

    public function saveDocuments()
    {
        $this->validate($this->getRules());

        if (!$this->studentId) {
            session()->flash('message', 'Data siswa tidak ditemukan.');
            return;
        }
        
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
                $path = $file->store('documents/' . $this->studentId, 'private'); 

                Document::updateOrCreate(
                    [
                        'student_id' => $this->studentId, 
                        'jenis_dokumen' => $jenis
                    ],
                    [
                        'no_dokumen' => $data['no'],
                        'file_path' => basename($path), 
                    ]
                );
            } elseif ($data['no'] !== null) {
                Document::where('student_id', $this->studentId)
                    ->where('jenis_dokumen', $jenis)
                    ->update(['no_dokumen' => $data['no']]);
            }
        }

        $this->reset([
            'akta_kelahiran', 'kartu_keluarga', 'ktp_ortu', 'nisn_skhun',
            'ijazah', 'rapor', 'pas_foto', 'surat_aktif_sekolah',
            'surat_kematian_ortu', 'surat_keterangan_tdk_mampu', 'sertifikat_tambahan'
        ]);

        $this->loadExistingDocuments();

        session()->flash('message', 'Dokumen berhasil diunggah dan disimpan!');
    }

    public function render()
    {
        return view('livewire.registration.document');
    }
}