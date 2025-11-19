<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students'; 

    protected $fillable = [
        'user_id',
        'nomor_pendaftaran',
        'nama_lengkap',
        'nisn',
        'nik_siswa',
        'jenis_kelamin',
        'tempat_kelahiran',
        'tanggal_lahir',
        'agama',
        'no_hp',
        'nama_ayah',
        'nama_ibu',
        'no_kk',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class, 'student_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'student_id');
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

    public function formSubmission()
    {
        return $this->hasOne(FormSubmission::class);
    }
}
