<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Form;
use App\Models\FormSubmission;

class FormSeeder extends Seeder
{
    public function run(): void
    {
        Form::create([
            'name' => 'Form Pendaftaran PPDB Online',
            'slug' => 'ppdb-online',
            'form_steps' => json_encode([
                [
                    'step_number' => 1,
                    'title' => 'Ketentuan PPDB Online',
                    'fields' => [
                        [
                            'name' => 'user_type',
                            'type' => 'select',
                            'label' => 'Pilih Jenis Pendaftaran',
                            'required' => true,
                            'options' => [
                                'MTS' => 'Siswa MTS',
                                'MA' => 'Siswa MA'
                            ]
                        ],
                        [
                            'name' => 'setuju_ketentuan',
                            'type' => 'checkbox',
                            'label' => 'Saya setuju dengan ketentuan pendaftaran',
                            'required' => true
                        ]
                    ]
                ],
                [
                    'step_number' => 2,
                    'title' => 'Identitas Diri Calon Siswa',
                    'fields' => [
                        ['name' => 'nomor_pendaftaran', 'type' => 'text', 'label' => 'Nomor Pendaftaran', 'required' => true],
                        ['name' => 'nama_lengkap', 'type' => 'text', 'label' => 'Nama Lengkap', 'required' => true],
                        ['name' => 'nisn', 'type' => 'text', 'label' => 'NISN', 'required' => true, 'validation' => 'digits:10'],
                        ['name' => 'nik_siswa', 'type' => 'text', 'label' => 'NIK Siswa', 'required' => true, 'validation' => 'digits:16'],
                        ['name' => 'jenis_pendaftaran', 'type' => 'select', 'label' => 'Jenis Pendaftaran', 'required' => true, 'options' => ['Baru' => 'Siswa Baru', 'Pindahan' => 'Pindahan']],
                        ['name' => 'jenis_kelamin', 'type' => 'select', 'label' => 'Jenis Kelamin', 'required' => true, 'options' => ['L' => 'Laki-laki', 'P' => 'Perempuan']],
                        ['name' => 'tempat_kelahiran', 'type' => 'text', 'label' => 'Tempat Kelahiran', 'required' => true],
                        ['name' => 'tanggal_lahir', 'type' => 'date', 'label' => 'Tanggal Lahir', 'required' => true],
                        ['name' => 'agama', 'type' => 'select', 'label' => 'Agama', 'required' => true, 'options' => ['Islam' => 'Islam', 'Kristen' => 'Kristen', 'Katolik' => 'Katolik', 'Hindu' => 'Hindu', 'Buddha' => 'Buddha', 'Konghucu' => 'Konghucu', 'Lainnya' => 'Lainnya']],
                        ['name' => 'status_keluarga', 'type' => 'select', 'label' => 'Status dalam Keluarga', 'options' => ['Anak Kandung' => 'Anak Kandung', 'Anak Tiri' => 'Anak Tiri', 'Anak Angkat' => 'Anak Angkat']],
                        ['name' => 'anak_ke', 'type' => 'number', 'label' => 'Anak Ke-', 'required' => true],
                        ['name' => 'jumlah_saudara', 'type' => 'number', 'label' => 'Jumlah Saudara Kandung', 'required' => true],
                        ['name' => 'hobi', 'type' => 'select', 'label' => 'Hobi', 'options' => ['Olahraga' => 'Olahraga', 'Kesenian' => 'Kesenian', 'Membaca' => 'Membaca', 'Menulis' => 'Menulis', 'Lainnya' => 'Lainnya']],
                        ['name' => 'cita_cita', 'type' => 'select', 'label' => 'Cita-cita', 'options' => ['PNS' => 'PNS', 'TNI/Polri' => 'TNI/Polri', 'Guru/Dosen' => 'Guru/Dosen', 'Dokter' => 'Dokter', 'Wiraswasta' => 'Wiraswasta', 'Lainnya' => 'Lainnya']],
                        ['name' => 'pernah_paud', 'type' => 'select', 'label' => 'Apakah pernah PAUD?', 'options' => ['Ya' => 'Ya', 'Tidak' => 'Tidak']],
                        ['name' => 'pernah_tk', 'type' => 'select', 'label' => 'Apakah pernah TK?', 'options' => ['Ya' => 'Ya', 'Tidak' => 'Tidak']],
                        ['name' => 'no_hp', 'type' => 'text', 'label' => 'No. Handphone / WA', 'required' => true, 'validation' => 'regex:/^[0-9+]{10,15}$/']
                    ]
                ],
                [
                    'step_number' => 3,
                    'title' => 'Alamat Calon Siswa',
                    'fields' => [
                        ['name' => 'jenis_tempat_tinggal', 'type' => 'select', 'label' => 'Jenis Tempat Tinggal', 'required' => true, 'options' => ['Asrama Pesantren' => 'Asrama Pesantren', 'Rumah Orang Tua' => 'Rumah Orang Tua', 'Kos' => 'Kos', 'Lainnya' => 'Lainnya']],
                        ['name' => 'alamat', 'type' => 'textarea', 'label' => 'Alamat', 'required' => true],
                        ['name' => 'desa', 'type' => 'text', 'label' => 'Desa', 'required' => true],
                        ['name' => 'kecamatan', 'type' => 'text', 'label' => 'Kecamatan', 'required' => true],
                        ['name' => 'kabupaten', 'type' => 'text', 'label' => 'Kabupaten', 'required' => true],
                        ['name' => 'provinsi', 'type' => 'text', 'label' => 'Provinsi', 'required' => true],
                        ['name' => 'kode_pos', 'type' => 'text', 'label' => 'Kode Pos', 'required' => true, 'validation' => 'digits:5'],
                        ['name' => 'jarak_ke_sekolah', 'type' => 'select', 'label' => 'Jarak ke Sekolah', 'options' => ['<1 km' => '<1 km', '1-3 km' => '1-3 km', '3-5 km' => '3-5 km', '>5 km' => '>5 km']],
                        ['name' => 'transportasi', 'type' => 'select', 'label' => 'Transportasi yang Digunakan', 'options' => ['Jalan Kaki' => 'Jalan Kaki', 'Sepeda' => 'Sepeda', 'Motor' => 'Motor', 'Mobil' => 'Mobil', 'Angkutan Umum' => 'Angkutan Umum', 'Lainnya' => 'Lainnya']]
                    ]
                ],
                [
                    'step_number' => 4,
                    'title' => 'Data Orang Tua / Wali',
                    'fields' => [
                        ['name' => 'no_kk', 'type' => 'text', 'label' => 'Nomor Kartu Keluarga', 'required' => true, 'validation' => 'digits:16'],
                        ['name' => 'nama_kepala_keluarga', 'type' => 'text', 'label' => 'Nama Kepala Keluarga', 'required' => true],
                        
                        // Ayah
                        ['name' => 'nama_ayah', 'type' => 'text', 'label' => 'Nama Ayah Kandung', 'required' => true],
                        ['name' => 'nik_ayah', 'type' => 'text', 'label' => 'NIK Ayah', 'required' => true, 'validation' => 'digits:16'],
                        ['name' => 'tahun_lahir_ayah', 'type' => 'text', 'label' => 'Tahun Lahir Ayah', 'required' => true],
                        ['name' => 'status_ayah', 'type' => 'select', 'label' => 'Status Ayah', 'options' => ['Hidup' => 'Hidup', 'Meninggal' => 'Meninggal']],
                        ['name' => 'pekerjaan_ayah', 'type' => 'text', 'label' => 'Pekerjaan Ayah'],
                        ['name' => 'penghasilan_ayah', 'type' => 'select', 'label' => 'Penghasilan Ayah', 'options' => ['Tidak ada' => '-','<500.000' => '<500.000', '500.000-1jt' => '500.000-1jt', '1jt-3jt' => '1jt-3jt', '3jt-5jt' => '3jt-5jt', '>5jt' => '>5jt']],
                        ['name' => 'pendidikan_ayah', 'type' => 'select', 'label' => 'Pendidikan Ayah', 'options' => ['Tidak ada' => '-','SD' => 'SD', 'SMP' => 'SMP', 'SMA' => 'SMA', 'D3' => 'D3', 'S1' => 'S1', 'S2' => 'S2', 'S3' => 'S3']],

                        // Ibu
                        ['name' => 'nama_ibu', 'type' => 'text', 'label' => 'Nama Ibu Kandung', 'required' => true],
                        ['name' => 'nik_ibu', 'type' => 'text', 'label' => 'NIK Ibu', 'required' => true, 'validation' => 'digits:16'],
                        ['name' => 'tahun_lahir_ibu', 'type' => 'text', 'label' => 'Tahun Lahir Ibu', 'required' => true],
                        ['name' => 'status_ibu', 'type' => 'select', 'label' => 'Status Ibu', 'options' => ['Hidup' => 'Hidup', 'Meninggal' => 'Meninggal']],
                        ['name' => 'pekerjaan_ibu', 'type' => 'text', 'label' => 'Pekerjaan Ibu'],
                        ['name' => 'penghasilan_ibu', 'type' => 'select', 'label' => 'Penghasilan Ibu', 'options' => ['Tidak ada' => '-','<500.000' => '<500.000', '500.000-1jt' => '500.000-1jt', '1jt-3jt' => '1jt-3jt', '3jt-5jt' => '3jt-5jt', '>5jt' => '>5jt']],
                        ['name' => 'pendidikan_ibu', 'type' => 'select', 'label' => 'Pendidikan Ibu', 'options' => ['Tidak ada' => '-','SD' => 'SD', 'SMP' => 'SMP', 'SMA' => 'SMA', 'D3' => 'D3', 'S1' => 'S1', 'S2' => 'S2', 'S3' => 'S3']],

                        // Wali
                        ['name' => 'nama_wali', 'type' => 'text', 'label' => 'Nama Wali'],
                        ['name' => 'nik_wali', 'type' => 'text', 'label' => 'NIK Wali'],
                        ['name' => 'tahun_lahir_wali', 'type' => 'text', 'label' => 'Tahun Lahir Wali'],
                        ['name' => 'pekerjaan_wali', 'type' => 'text', 'label' => 'Pekerjaan Wali'],
                        ['name' => 'penghasilan_wali', 'type' => 'select', 'label' => 'Penghasilan Wali', 'options' => ['Tidak ada' => '-','<500.000' => '<500.000', '500.000-1jt' => '500.000-1jt', '1jt-3jt' => '1jt-3jt', '3jt-5jt' => '3jt-5jt', '>5jt' => '>5jt']],
                        ['name' => 'pendidikan_wali', 'type' => 'select', 'label' => 'Pendidikan Wali', 'options' => ['Tidak ada' => '-', 'SD' => 'SD', 'SMP' => 'SMP', 'SMA' => 'SMA', 'D3' => 'D3', 'S1' => 'S1', 'S2' => 'S2', 'S3' => 'S3']],
                        ['name' => 'no_hp_wali', 'type' => 'text', 'label' => 'No. HP Orang Tua/Wali'],

                        // Kepemilikan Kartu
                        ['name' => 'kks', 'type' => 'text', 'label' => 'Nomor Kartu Keluarga Sejahtera (KKS)'],
                        ['name' => 'pkh', 'type' => 'text', 'label' => 'Nomor Program Keluarga Harapan (PKH)'],
                        ['name' => 'kip', 'type' => 'text', 'label' => 'Nomor Kartu Indonesia Pintar (KIP)']
                    ]
                ],
                [
                    'step_number' => 5,
                    'title' => 'Data Sekolah Asal',
                    'fields' => [
                        ['name' => 'nama_sekolah', 'type' => 'text', 'label' => 'Nama Sekolah', 'required' => true],
                        ['name' => 'jenjang_sekolah', 'type' => 'select', 'label' => 'Jenjang Sekolah', 'options' => ['SD' => 'SD', 'SMP' => 'SMP', 'SMA' => 'SMA', 'SMK' => 'SMK']],
                        ['name' => 'status_sekolah', 'type' => 'select', 'label' => 'Status Sekolah', 'options' => ['Negeri' => 'Negeri', 'Swasta' => 'Swasta']],
                        ['name' => 'npsn_sekolah', 'type' => 'text', 'label' => 'NPSN Sekolah', 'required' => true, 'validation' => 'digits:8'],
                        ['name' => 'lokasi_sekolah', 'type' => 'text', 'label' => 'Lokasi Sekolah', 'required' => true],
                    ]
                ]
            ]),
        ]);


        // FormSubmission::create([
        //     'form_id' => '1',
        //     'submission_data' => [ 
        //         [ 
        //             "kip" => "rrr",
        //             "kks" => "rrr",
        //             "pkh" => "rrr",
        //             "desa" => "vbnm",
        //             "hobi" => "Olahraga",
        //             "nisn" => "1234567812",
        //             "agama" => "Lainnya",
        //             "no_hp" => "0892345678",
        //             "no_kk" => "1234567812345678",
        //             "alamat" => "Jl msms",
        //             "anak_ke" => "1",
        //             "nik_ibu" => "1234567812345678",
        //             "kode_pos" => "12345",
        //             "nama_ibu" => "rrr",
        //             "nik_ayah" => "1234567812345678",
        //             "nik_wali" => "1234567812345678",
        //             "provinsi" => "vbnm",
        //             "cita_cita" => "PNS",
        //             "kabupaten" => "vbnm",
        //             "kecamatan" => "vbnm",
        //             "nama_ayah" => "rrr",
        //             "nama_wali" => "rrr",
        //             "nik_siswa" => "1234567812345678",
        //             "pernah_tk" => "Tidak",
        //             "user_type" => "MTS",
        //             "no_hp_wali" => "0812345678",
        //             "status_ibu" => "Hidup",
        //             "berkas_path" => "public/pendaftaran/GA3iU1guZulQcA1KoB51k7b3KkqI2iyL8SD4ukBZ.png",
        //             "pernah_paud" => "Ya",
        //             "status_ayah" => "Hidup",
        //             "nama_lengkap" => "ddfghjk",
        //             "nama_sekolah" => "mjsks",
        //             "npsn_sekolah" => "12345678",
        //             "transportasi" => "Lainnya",
        //             "jenis_kelamin" => "L",
        //             "pekerjaan_ibu" => "rrr",
        //             "tanggal_lahir" => "2007-07-07",
        //             "jumlah_saudara" => "1",
        //             "lokasi_sekolah" => "kkakak",
        //             "pekerjaan_ayah" => "rrr",
        //             "pekerjaan_wali" => "rrr",
        //             "pendidikan_ibu" => "SMP",
        //             "status_sekolah" => "Negeri",
        //             "jenjang_sekolah" => "SMP",
        //             "pendidikan_ayah" => "SD",
        //             "pendidikan_wali" => "SMP",
        //             "penghasilan_ibu" => "<500.000",
        //             "status_keluarga" => "Anak Tiri",
        //             "tahun_lahir_ibu" => "rrr",
        //             "jarak_ke_sekolah" => "1-3 km",
        //             "penghasilan_ayah" => "500.000-1jt",
        //             "penghasilan_wali" => "",
        //             "setuju_ketentuan" => null,
        //             "tahun_lahir_ayah" => "rrr",
        //             "tahun_lahir_wali" => "rrr",
        //             "tempat_kelahiran" => "ghjkl",
        //             "jenis_pendaftaran" => "Baru",
        //             "nomor_pendaftaran" => "2025-2030909207",
        //             "jenis_tempat_tinggal" => "Rumah Orang Tua",
        //             "nama_kepala_keluarga" => "1234567812345678"
        //         ] 
        //     ] 
        // ]);
    }
}
