<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Student;

class UserFactory extends Factory
{
    public function definition(): array
    {
        $nama = $this->faker->name();
        $nomorPendaftaran = $this->faker->unique()->numberBetween(100000, 999999);
        $nisn = $this->faker->numerify('##########'); 

        return [
            'name' => $nama,
            'email' => $nomorPendaftaran,
            'email_verified_at' => now(),
            'password' => Hash::make($nisn),
            'remember_token' => Str::random(10),
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}