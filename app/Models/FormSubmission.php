<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class FormSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'form_id',
        'student_id',
        'submission_data',
    ];

    protected $casts = [
        'submission_data' => 'array', 
    ];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}