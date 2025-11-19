<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'type',
        'tahun',
        'gelombang_aktif',
        'is_open',
        'form_steps',
    ];

    protected $casts = [
        'form_steps' => 'array', 
    ];

    public function submissions()
    {
        return $this->hasMany(FormSubmission::class);
    }
}