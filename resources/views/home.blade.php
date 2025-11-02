@extends('layouts.app')

@section('content')
    {{-- Hero Section --}}
    <section
        class="text-center py-40 bg-gradient-to-b from-yellow-50 to-yellow-100 bg-[url('/images/bg-pattern.png')] bg-cover bg-blend-overlay">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="mx-auto w-36 mb-8 drop-shadow-md">
        <h1 class="text-4xl md:text-5xl font-extrabold text-gray-800 leading-snug mb-8 animate-pulse">
            SELAMAT DATANG DI<br>
            <span class="text-yellow-600 animate-pulse">PPDB MISBAHUNNUR CIMAHI</span>
        </h1>

        <div class="flex justify-center space-x-6">
            <a href="{{ route('registration.form', ['slug' => 'ppdb-online']) }}"
                class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-8 py-3 rounded-full shadow-lg transform hover:-translate-y-1 transition-all duration-300">
                PENDAFTARAN
            </a>
            <a href="{{ route('login.siswa') }}"
                class="bg-red-500 hover:bg-red-600 text-white font-semibold px-8 py-3 rounded-full shadow-lg transform hover:-translate-y-1 transition-all duration-300">
                MASUK SISWA
            </a>
        </div>
    </section>

    {{-- Alur Daftar Ulang --}}
    <section id="alur"
        class="py-16 bg-gradient-to-b from-green to-white bg-[url('/images/bg-pattern.png')] bg-cover bg-blend-overlay">
        <div class="container mx-auto text-center px-6">
            <h2 class="text-3xl font-bold text-green-800 mb-6">ALUR DAFTAR ULANG</h2>
            <p class="text-green-900 font-semibold bg-green-100 inline-block px-5 py-2 rounded-lg shadow-sm">
                CALON PESERTA DIDIK BARU YANG DINYATAKAN LULUS SELEKSI HARUS MELAKSANAKAN PROSES DAFTAR ULANG
            </p>

            <div class="grid md:grid-cols-3 lg:grid-cols-6 gap-8 mt-12">
                @php
                    $steps = [
                        ['1', 'bg-green-600', 'Tata cara daftar ulang online dapat diakses di website resmi.'],
                        ['2', 'bg-green-600', 'Mengisi data peserta didik baru secara online dan menyerahkan printout-nya saat daftar ulang.'],
                        ['3', 'bg-yellow-500', 'Menyerahkan berkas daftar ulang ke panitia pada waktu yang telah dijadwalkan.'],
                        ['4', 'bg-yellow-500', 'Menandatangani surat pernyataan peraturan calon peserta didik.'],
                        ['5', 'bg-blue-600', 'Menyerahkan Surat Keterangan Lulus (SKL).'],
                        ['6', 'bg-orange-500', 'Calon peserta didik baru yang lolos verifikasi mengikuti kegiatan MATSAMA.'],
                    ];
                @endphp

                @foreach ($steps as [$num, $color, $desc])
                    <div
                        class="flex flex-col items-center bg-white rounded-2xl shadow-md hover:shadow-xl p-6 transition-all duration-300 transform hover:-translate-y-1">
                        <div
                            class="{{ $color }} text-white w-14 h-14 flex items-center justify-center rounded-full text-xl font-bold shadow-md">
                            {{ $num }}
                        </div>
                        <p class="mt-4 text-gray-700 text-center text-sm font-medium">{{ $desc }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Informasi PPDB --}}
    <section class="py-16 text-center bg-white">
        <h2 class="text-3xl font-bold text-green-800 mb-6">INFORMASI PPDB ONLINE</h2>
        <div class="max-w-4xl mx-auto text-gray-700 leading-relaxed text-lg px-6">
            <p>
                <span class="font-semibold text-yellow-600">Penerimaan Peserta Didik Baru (PPDB) Online</span>
                adalah sistem yang dirancang untuk memudahkan proses penerimaan murid baru di
                <span class="font-semibold text-green-700">MISBAHUNNUR CIMAHI</span>.
                Dengan teknologi informasi, proses penerimaan menjadi lebih efisien, transparan, dan akurat.
            </p>
            <p class="mt-4">
                Harap diperhatikan pengisian data dengan benar, karena akan digunakan dalam seluruh proses PPDB.
                Setelah pengisian formulir berhasil, calon siswa akan mendapatkan
                <span class="font-semibold text-blue-600">nomor pendaftaran</span>
                yang wajib disimpan untuk proses selanjutnya.
            </p>
        </div>
    </section>

    {{-- Syarat Pendaftaran --}}
    <section id="syarat" class="py-20 bg-gray-50 bg-gradient-to-b from-white to-green-50">
        <div class="container mx-auto px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-green-800 mb-6 text-center">SYARAT PENDAFTARAN</h2>
            <div class="text-center mb-6">
                <i class="fas fa-clipboard-list text-4xl text-green-700 mr-4"></i>
                <p class="text-green-900 font-semibold bg-green-100 inline-block px-5 py-2 rounded-lg shadow-sm">
                    Persyaratan Calon Peserta Didik Baru
                </p>
            </div>
            <div
                class="max-w-3xl mx-auto bg-white flex flex-col bg-white rounded-2xl shadow-md hover:shadow-xl p-6 transition-all duration-300 transform hover:-translate-y-1 ">


                <ul class="list-none space-y-3 font-bold text-gray-700 text-base">
                    <li class="flex items-center"><i class="fas fa-check-circle text-green-500 mr-3"></i> 1. Mengisi
                        Formulir Pendaftaran</li>
                    <li class="flex items-center"><i class="fas fa-check-circle text-green-500 mr-3"></i> 2. Berusia
                        maksimal 21 tahun pada 1 Juli 2021</li> {{-- Sesuaikan tahun jika perlu --}}
                    <li class="flex items-center"><i class="fas fa-check-circle text-green-500 mr-3"></i> 3. Menyerahkan
                        Foto Hitam Putih ukuran 3x4 (2 lembar)</li>
                    <li class="flex items-center"><i class="fas fa-check-circle text-green-500 mr-3"></i> 4. Ijazah Asli
                        SD/MI + Fotokopi 1 lembar</li>
                    <li class="flex items-center"><i class="fas fa-check-circle text-green-500 mr-3"></i> 5. Fotokopi Raport
                        Semester 5 (legalisir 1 lembar)</li>
                    <li class="flex items-center"><i class="fas fa-check-circle text-green-500 mr-3"></i> 6. Piagam Asli &
                        Fotokopi Kejuaraan (jika ada)</li>
                    <li class="flex items-center"><i class="fas fa-check-circle text-green-500 mr-3"></i> 7. Fotokopi Kartu
                        Keluarga (3 lembar)</li>
                    <li class="flex items-center"><i class="fas fa-check-circle text-green-500 mr-3"></i> 8. Fotokopi PKH
                        dan KIP (jika ada)</li>
                </ul>
            </div>
        </div>
    </section>
@endsection