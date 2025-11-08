<?php

namespace Database\Seeders;

use App\Models\Fees;
use App\Models\FormSubmission;
use App\Models\Payment;
use App\Models\Registration;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        $this->call([
            UserSeeder::class,
            FormSeeder::class,
        ]);

        $students = Student::factory(10)->create();
        
        DB::transaction(function () use ($students) {
            foreach ($students as $student) {
                $user = User::create([
                    'name' => $student->nama_lengkap,
                    'email' => $student->nomor_pendaftaran,
                    'password' => Hash::make($student->nisn),
                    'email_verified_at' => now(),
                    'remember_token' => Str::random(10)
                ]);

                $student->update(['user_id' => $user->id]);

                Registration::factory()->create([
                    'student_id' => $student->id,
                ]);
                FormSubmission::factory()->create([
                    'student_id' => $student->id,
                ]);
            }
        });

        Fees::factory(5)->create();
        Payment::factory(5)->create();

    }
}
