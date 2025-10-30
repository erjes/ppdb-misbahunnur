<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Model
{
    use HasFactory;

    protected $table = 'addresses';

    protected $fillable = [
        'student_id',
        'alamat',
        'rt',
        'rw',
        'desa',
        'kecamatan',
        'kota',
        'provinsi',
        'kode_pos',
        'koordinat',
        'transportasi',
        'status_tinggal',
        'jarak',
        'waktu',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
