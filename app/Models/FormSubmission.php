<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'form_id',
        'user_type',
        'submission_data',
    ];

    protected $casts = [
        'submission_data' => 'array', 
    ];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}