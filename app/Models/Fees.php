<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fees extends Model
{
    use HasFactory;

    protected $table = 'fees';

    protected $fillable = [
        'nama_biaya',
        'jumlah',
        'aktif',
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
