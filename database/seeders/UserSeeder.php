<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Enums\UserRole;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin.ma@misbahunnur.com'],
            [
                'name' => 'Admin MA',
                'password' => Hash::make('12345678'),
                'role' => UserRole::admin_ma->value,
                'is_active' => true,
            ]
        );

        User::updateOrCreate(
            ['email' => 'admin.mts@misbahunnur.com'],
            [
                'name' => 'Admin MTS',
                'password' => Hash::make('12345678'),
                'role' => UserRole::admin_mts->value,
                'is_active' => true,
            ]
        );
    }
}
