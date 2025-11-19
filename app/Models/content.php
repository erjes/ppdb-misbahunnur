<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class content extends Model
{
    //
     public $timestamps = false;
    protected $table = 'contents';
    protected $fillable = [
        'content',
        'filename',
        'title'
    ];

}
