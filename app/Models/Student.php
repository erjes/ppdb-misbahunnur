<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'no_daftar',
        'nisn',
        'nik',
        'no_kk',
        'nis',
        'nama',
        'jenis_kelamin',
        'tempat_lahir',
        'tgl_lahir',
        'agama',
        'asal_sekolah',
        'npsn_asal',
        'jenjang',
        'jurusan',
        'foto',
        'anak_ke',
        'status_keluarga',
        'paud',
        'tk',
        'citacita',
        'hobi',
        'sekolah_tujuan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function address()
    {
        return $this->hasOne(Address::class);
    }

    public function parents()
    {
        return $this->hasMany(ParentData::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function healthRecord()
    {
        return $this->hasOne(HealthRecord::class);
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }

    public function registration()
    {
        return $this->hasOne(Registration::class);
    }
}
