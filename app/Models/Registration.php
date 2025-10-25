<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'tgl_daftar',
        'tgl_konfirmasi',
        'is_confirmed',
        'is_active',
        'status',
        'level',
        'tgl_keluar',
        'alasan_keluar',
        'online',
        'is_paid',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
