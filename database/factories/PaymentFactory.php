<?php

namespace Database\Factories;

use App\Models\Payment;
use App\Models\User;
use App\Models\Fees;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    protected $model = Payment::class;

    public function definition()
    {
        return [
            'fee_id' => Fees::factory(),
            'jumlah' => 300000,
            'bukti_pembayaran' => $this->faker->numerify('#############'),
            'tanggal_bayar' => $this->faker->date(),
            'verifikasi' => $this->faker->boolean(),
        ];
    }
}
