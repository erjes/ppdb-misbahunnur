<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Document extends Model
{
    use HasFactory;

    protected $table = 'documents';

    protected $fillable = [
        'student_id',
        'jenis_dokumen',
        'no_dokumen',
        'file_path',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
