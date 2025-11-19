<?php

namespace App\Exports;

use App\Models\Student;
use App\Models\FormSubmission;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StudentsExport implements FromQuery, WithHeadings, WithMapping
{
    public function __construct(
        protected string $jenjang,        
        protected ?string $search = null,
        protected ?string $sort = 'students.created_at',
        protected ?string $dir = 'desc',
        protected ?string $tahun = null,
        protected ?string $gelombang = null
    ) {}

    public function query()
    {
        $q = Student::query()
            ->select([
                'students.id',
                'students.nomor_pendaftaran',
                'students.nama_lengkap',
                'students.nisn',
                'students.nik_siswa',
                'registrations.status as reg_status',
                'registrations.is_paid',
                'registrations.jenjang_daftar',
                'students.created_at',
                'form_submissions.submission_data',  
            ])
            ->join('registrations', 'registrations.student_id', '=', 'students.id')
            ->leftJoin('form_submissions', 'form_submissions.student_id', '=', 'students.id')
            ->leftJoin('forms', 'forms.id', '=', 'form_submissions.form_id') 
            ->where('registrations.jenjang_daftar', strtoupper($this->jenjang))
            ->where('registrations.status', 'approved')
            ->where('registrations.is_paid', 1)
            ->whereYear('students.created_at', $this->tahun)  
            ->where('forms.gelombang_aktif', $this->gelombang)
            ->when($this->search, function (Builder $query) {
                $search = '%' . str_replace(' ', '%', $this->search) . '%';
                $query->where(function (Builder $subQuery) use ($search) {
                    $subQuery->where('students.nama_lengkap', 'like', $search)
                        ->orWhere('students.nomor_pendaftaran', 'like', $search)
                        ->orWhere('students.nisn', 'like', $search)
                        ->orWhere('students.nik_siswa', 'like', $search);
                });
            });

        $allowedSorts = [
            'students.created_at',
            'students.nama_lengkap',
            'students.nomor_pendaftaran',
            'students.nisn',
        ];
        $sortField = in_array($this->sort, $allowedSorts, true) ? $this->sort : 'students.created_at';
        $dir = strtolower($this->dir) === 'asc' ? 'asc' : 'desc';

        return $q->orderBy($sortField, $dir);
    }

    public function headings(): array
    {
        return [
            'Nomor Pendaftaran',
            'Nama Lengkap',
            'NISN',
            'NIK',
            'Status Registrasi',
            'Paid',
            'Jenjang',
            'Dibuat Pada',
            'Nama Ayah',
            'Nama Ibu',
            'No HP',
            'Tanggal Lahir',
            'Jenjang Sekolah',
            'Nama Sekolah',
            'NPSN Sekolah',
            'Status Sekolah',
            'Lokasi Sekolah',
            'Status Keluarga',
            'Jumlah Saudara',
            'Jenis Tempat Tinggal',
            'Tempat Kelahiran',
            'Agama',
            'Jenis Kelamin',
            'Cita-Cita',
            'Hobi',
            'Pernah TK',
            'Pernah PAUD',
            'No HP Wali',
            'Penghasilan Ayah',
            'Penghasilan Ibu',
            'Pekerjaan Ayah',
            'Pekerjaan Ibu',
            'Pekerjaan Wali',
            'NIK Ayah',
            'NIK Ibu',
            'NIK Wali',
            'KKS',
            'PKH',
            'KIP',
            'Kode Pos',
            'Jarak ke Sekolah',
            'Transportasi',
            'No KK',
            'Status Ayah',
            'Status Ibu',
            'Tahun Lahir Ayah',
            'Tahun Lahir Ibu',
            'Tahun Lahir Wali',
            'Nama Kepala Keluarga',
            'Jalur Daftar',
            'Jenis Daftar',
        ];
    }
    

    public function map($row): array
    {
        $formSubmissionData = json_decode($row->submission_data, true);
    
        return [
            $row->nomor_pendaftaran ?? 'N/A',  
            $row->nama_lengkap ?? 'N/A',         
            $row->nisn ?? 'N/A',                
            $row->nik_siswa ?? 'N/A',          
            $row->reg_status ?? 'N/A', 
            $row->is_paid ? 'Yes' : 'No',
            $row->jenjang_daftar ?? 'N/A',
            optional($row->created_at)->format('Y-m-d H:i:s') ?? 'N/A',
            $formSubmissionData['nama_ayah'] ?? 'N/A',
            $formSubmissionData['nama_ibu'] ?? 'N/A',
            $formSubmissionData['no_hp'] ?? 'N/A',
            $formSubmissionData['tanggal_lahir'] ?? 'N/A',
            $formSubmissionData['jenjang_sekolah'] ?? 'N/A',
            $formSubmissionData['nama_sekolah'] ?? 'N/A',
            $formSubmissionData['npsn_sekolah'] ?? 'N/A',
            $formSubmissionData['status_sekolah'] ?? 'N/A',
            $formSubmissionData['lokasi_sekolah'] ?? 'N/A',
            $formSubmissionData['status_keluarga'] ?? 'N/A',
            $formSubmissionData['jumlah_saudara'] ?? 'N/A',
            $formSubmissionData['jenis_tempat_tinggal'] ?? 'N/A',
            $formSubmissionData['tempat_kelahiran'] ?? 'N/A',
            $formSubmissionData['agama'] ?? 'N/A',
            $formSubmissionData['jenis_kelamin'] ?? 'N/A',
            $formSubmissionData['cita_cita'] ?? 'N/A',
            $formSubmissionData['hobi'] ?? 'N/A',
            $formSubmissionData['pernah_tk'] ?? 'N/A',
            $formSubmissionData['pernah_paud'] ?? 'N/A',
            $formSubmissionData['no_hp_wali'] ?? 'N/A',
            $formSubmissionData['penghasilan_ayah'] ?? 'N/A',
            $formSubmissionData['penghasilan_ibu'] ?? 'N/A',
            $formSubmissionData['pekerjaan_ayah'] ?? 'N/A',
            $formSubmissionData['pekerjaan_ibu'] ?? 'N/A',
            $formSubmissionData['pekerjaan_wali'] ?? 'N/A',
            $formSubmissionData['nik_ayah'] ?? 'N/A',
            $formSubmissionData['nik_ibu'] ?? 'N/A',
            $formSubmissionData['nik_wali'] ?? 'N/A',
            $formSubmissionData['kks'] ?? 'N/A',
            $formSubmissionData['pkh'] ?? 'N/A',
            $formSubmissionData['kip'] ?? 'N/A',
            $formSubmissionData['kode_pos'] ?? 'N/A',
            $formSubmissionData['jarak_ke_sekolah'] ?? 'N/A',
            $formSubmissionData['transportasi'] ?? 'N/A',
            $formSubmissionData['no_kk'] ?? 'N/A',
            $formSubmissionData['status_ayah'] ?? 'N/A',
            $formSubmissionData['status_ibu'] ?? 'N/A',
            $formSubmissionData['tahun_lahir_ayah'] ?? 'N/A',
            $formSubmissionData['tahun_lahir_ibu'] ?? 'N/A',
            $formSubmissionData['tahun_lahir_wali'] ?? 'N/A',
            $formSubmissionData['nama_kepala_keluarga'] ?? 'N/A',
            $formSubmissionData['jalur_daftar'] ?? 'N/A',
            $formSubmissionData['jenis_daftar'] ?? 'N/A',
        ];
    }
}
