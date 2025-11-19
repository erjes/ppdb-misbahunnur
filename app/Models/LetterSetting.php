<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class LetterSetting extends Model
{
    protected $guarded = [];

    public function getSignatureUrlAttribute()
    {
        return $this->signature_path ? Storage::url($this->signature_path) : null;
    }

    public function getStampUrlAttribute()
    {
        return $this->stamp_path ? Storage::url($this->stamp_path) : null;
    }
}