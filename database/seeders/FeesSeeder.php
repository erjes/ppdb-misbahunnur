<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fees; 

class FeesSeeder extends Seeder
{
    public function run(): void
    {
        Fees::create([
            'nama_biaya' => 'Pendaftaran',
            'jumlah' => 300000,
        ]);
    }
}