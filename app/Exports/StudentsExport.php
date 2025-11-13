<?php

namespace App\Exports;

use App\Models\Student;
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
            ])
            ->join('registrations', 'registrations.student_id', '=', 'students.id')
            ->where('registrations.jenjang_daftar', strtoupper($this->jenjang));

        if ($this->search) {
            $s = '%' . str_replace(' ', '%', $this->search) . '%';
            $q->where(function (Builder $w) use ($s) {
                $w->where('students.nama_lengkap', 'like', $s)
                    ->orWhere('students.nomor_pendaftaran', 'like', $s)
                    ->orWhere('students.nisn', 'like', $s)
                    ->orWhere('students.nik_siswa', 'like', $s);
            });
        }

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
            'ID',
            'Nomor Pendaftaran',
            'Nama Lengkap',
            'NISN',
            'NIK',
            'Status Registrasi',
            'Paid',
            'Jenjang',
            'Dibuat Pada',
        ];
    }

    public function map($row): array
    {
        return [
            $row->id,
            $row->nomor_pendaftaran,
            $row->nama_lengkap,
            $row->nisn,
            (string)$row->nik_siswa,
            $row->reg_status,
            $row->is_paid ? 'Yes' : 'No',
            $row->jenjang_daftar,
            optional($row->created_at)->format('Y-m-d H:i:s'),
        ];
    }
}
