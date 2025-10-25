<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HealthRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'hepatitis',
        'polio',
        'bcg',
        'campak',
        'dpt',
        'covid',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
