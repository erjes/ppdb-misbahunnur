<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';

    protected $fillable = [
        'student_id',
        'fee_id',
        'bukti_pembayaran',
        'jumlah',
        'tanggal_bayar',
        'verifikasi',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }


    public function fee()
    {
        return $this->belongsTo(Fees::class);
    }
}
