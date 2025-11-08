<?php
namespace Database\Factories;

use App\Models\FormSubmission;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class FormSubmissionFactory extends Factory
{
    protected $model = FormSubmission::class;

    public function definition()
    {
        return [
            'student_id' => Student::factory(),
            'form_id' => 1,
            'submission_data' => json_encode([
                'jalur_daftar' =>  $this->faker->randomElement(['Prestasi', 'Yatim', 'Dhuafa', 'Reguler']),
                'jenjang_daftar' =>  $this->faker->randomElement(['MTS', 'MA']),
                'kip' => $this->faker->word(),
                'kks' => $this->faker->word(),
                'pkh' => $this->faker->word(),
                'desa' => $this->faker->word(),
                'hobi' => 'Olahraga',  // Static value
                'nisn' => $this->faker->numerify('############'),
                'agama' => 'Lainnya',  // Static value
                'no_hp' => $this->faker->phoneNumber(),
                'no_kk' => $this->faker->numerify('#############'),
                'alamat' => $this->faker->address(),
                'anak_ke' => $this->faker->numberBetween(1, 5),
                'nik_ibu' => $this->faker->numerify('#############'),
                'kode_pos' => $this->faker->numerify('#####'),
                'nama_ibu' => $this->faker->name(),
                'nik_ayah' => $this->faker->numerify('#############'),
                'nik_wali' => $this->faker->numerify('#############'),
                'provinsi' => $this->faker->state(),
                'cita_cita' => 'PNS',  // Static value
                'kabupaten' => $this->faker->word(),
                'kecamatan' => $this->faker->word(),
                'nama_ayah' => $this->faker->name(),
                'nama_wali' => $this->faker->name(),
                'nik_siswa' => $this->faker->numerify('#############'),
                'pernah_tk' => 'Tidak',  // Static value
                'no_hp_wali' => $this->faker->phoneNumber(),
                'status_ibu' => 'Hidup',  // Static value
                'berkas_path' => 'public/pendaftaran/GA3iU1guZulQcA1KoB51k7b3KkqI2iyL8SD4ukBZ.png', // Static example file
                'pernah_paud' => 'Ya',  // Static value
                'status_ayah' => 'Hidup',  // Static value
                'nama_lengkap' => $this->faker->name(),
                'nama_sekolah' => $this->faker->company(),
                'npsn_sekolah' => $this->faker->numerify('##########'),
                'transportasi' => 'Lainnya',  // Static value
                'jenis_kelamin' => $this->faker->randomElement(['L', 'P']),
                'pekerjaan_ibu' => $this->faker->word(),
                'tanggal_lahir' => $this->faker->date(),
                'jumlah_saudara' => $this->faker->numberBetween(1, 5),
                'lokasi_sekolah' => $this->faker->word(),
                'pekerjaan_ayah' => $this->faker->word(),
                'pekerjaan_wali' => $this->faker->word(),
                'pendidikan_ibu' => $this->faker->randomElement(['SMP', 'SMA', 'S1', 'S2']),
                'status_sekolah' => $this->faker->randomElement(['Negeri', 'Swasta']),
                'jenjang_sekolah' => $this->faker->randomElement(['SD', 'SMP', 'SMA']),
                'pendidikan_ayah' => $this->faker->randomElement(['SMP', 'SMA', 'S1', 'S2']),
                'pendidikan_wali' => $this->faker->randomElement(['SMP', 'SMA', 'S1', 'S2']),
                'penghasilan_ibu' => $this->faker->randomElement(['<500.000', '500.000-1jt', '1jt-2jt']),
                'status_keluarga' => $this->faker->randomElement(['Anak Kandung', 'Anak Tiri']),
                'tahun_lahir_ibu' => $this->faker->year(),
                'jarak_ke_sekolah' => $this->faker->randomElement(['1-3 km', '3-5 km', '5-10 km']),
                'penghasilan_ayah' => $this->faker->randomElement(['<500.000', '500.000-1jt', '1jt-2jt']),
                'penghasilan_wali' => '',
                'setuju_ketentuan' => null,
                'tahun_lahir_ayah' => $this->faker->year(),
                'tahun_lahir_wali' => $this->faker->year(),
                'tempat_kelahiran' => $this->faker->word(),
                'jenis_pendaftaran' => 'Baru',  
                'nomor_pendaftaran' => $this->faker->unique()->numerify('2025-#######'),
                'jenis_tempat_tinggal' => 'Rumah Orang Tua',  
                'nama_kepala_keluarga' => $this->faker->numerify('#############')
            ]),
        ];
    }
}

