<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ParentData extends Model
{
    use HasFactory;

    protected $table = 'parents'; 

    protected $fillable = [
        'student_id',
        'hubungan',
        'nik',
        'nama',
        'tempat_lahir',
        'tahun_lahir',
        'pendidikan',
        'pekerjaan',
        'penghasilan',
        'no_hp',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
