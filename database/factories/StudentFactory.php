<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'nomor_pendaftaran' => $this->faker->unique()->numerify('#######'),
            'nama_lengkap' => $this->faker->name(),
            'nisn' => $this->faker->numerify('########'),
            'nik_siswa' => $this->faker->numerify('################'),
            'jenis_kelamin' => $this->faker->randomElement(['L', 'P']),
            'tempat_kelahiran' => $this->faker->city(),
            'tanggal_lahir' => $this->faker->date(),
            'agama' => $this->faker->randomElement(['Islam', 'Kristen', 'Hindu', 'Budha']),
            'no_hp' => $this->faker->numerify('###############'),
            'nama_ayah' => $this->faker->name(),
            'nama_ibu' => $this->faker->name(),
            'no_kk' => $this->faker->numerify('#############'),
        ];
    }
}
