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
            'nama_biaya' => $this->faker->word(),
            'jumlah' => $this->faker->numberBetween(50000, 500000),
        ];
    }
}
