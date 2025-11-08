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
            'user_id' => User::factory(),
            'fee_id' => Fees::factory(),
            'jumlah' => $this->faker->numberBetween(50000, 500000),
            'kode_pembayaran' => $this->faker->numerify('#############'),
            'tanggal_bayar' => $this->faker->date(),
            'verifikasi' => $this->faker->boolean(),
        ];
    }
}
