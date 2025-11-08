<?php

namespace Database\Factories;

use App\Models\Registration;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class RegistrationFactory extends Factory
{
    protected $model = Registration::class;

    public function definition()
    {
        return [
            'student_id' => Student::factory(),
            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
            'tanggal_daftar' => $this->faker->date(),
            'jalur_daftar' => $this->faker->randomElement(['Reguler', 'Beasiswa']),
            'jenjang_daftar' => $this->faker->randomElement(['MA', 'MTS']),
        ];
    }
}
