<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Registration extends Model
{
    use HasFactory;
    
    protected $table = 'registrations';

    protected $fillable = [
        'student_id',
        'tanggal_daftar',
        'tgl_konfirmasi',
        'is_confirmed',
        'is_active',
        'status',
        'jenjang_daftar',
        'jalur_daftar',
        'tanggal_keluar',
        'alasan_keluar',
        'online',
        'is_paid',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
