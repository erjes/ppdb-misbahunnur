<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Grade extends Model
{
    use HasFactory;

    protected $table = 'grades';

    protected $fillable = [
        'student_id',
        'mapel',
        'semester',
        'nilai',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
