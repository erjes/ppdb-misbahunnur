<?php


namespace Database\Factories;

use App\Models\Fees;
use Illuminate\Database\Eloquent\Factories\Factory;

class FeesFactory extends Factory
{
    protected $model = Fees::class;

    public function definition()
    {
        return [
            'nama_biaya' => 'Pendaftaran',
            'jumlah' => 300000,
        ];
    }
}
