<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'PPDB Misbahunnur Cimahi') }}</title>

  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />

  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

  <link rel="icon" type="image/x-icon" href="{{ asset('images/logo.png') }}">


  @filamentStyles
  @vite('resources/css/app.css')

  <style>
    body {
      background-repeat: repeat;
      background-size: contain;
    }

    .navbar-fixed {
      position: sticky;
      top: 0;
      z-index: 50;
    }

    .nav-link {
      transition: all 0.2s ease-in-out;
    }

    .nav-link:hover {
      opacity: 0.8;
      transform: translateY(-1px);
    }
  </style>
</head>

<body class="font-sans antialiased text-gray-800 bg-white">

  <div class="min-h-screen flex flex-col">

    <header class="navbar-fixed">
      @include('layouts.component.guest-navigation')
    </header>

    @isset($header)
      <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
          {{ $header }}
        </div>
      </header>
    @endisset

    <main class="flex-grow pt-20">
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
          <a href="{{ route('student.login') }}"
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
                  [
                      '2',
                      'bg-green-600',
                      'Mengisi data peserta didik baru secara online dan menyerahkan printout-nya saat daftar ulang.',
                  ],
                  [
                      '3',
                      'bg-yellow-500',
                      'Menyerahkan berkas daftar ulang ke panitia pada waktu yang telah dijadwalkan.',
                  ],
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

      <section class="py-16 bg-gradient-to-br from-green-50 via-white to-yellow-50">
        <div class="container mx-auto px-6">
          <h2 class="text-3xl font-bold text-green-800 mb-10 text-center">INFORMASI PPDB ONLINE</h2>

          <div class="max-w-5xl mx-auto">
            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border-4 border-green-500 mb-8">
              <div class="bg-gradient-to-r from-green-600 to-green-500 p-6 text-center">
                <i class="fas fa-info-circle text-white text-5xl mb-3"></i>
                <h3 class="text-2xl font-bold text-white">Tentang PPDB Online</h3>
              </div>

              <div class="p-8">
                <div class="bg-yellow-50 border-l-4 border-yellow-500 p-6 mb-6 rounded-r-lg">
                  <p class="text-gray-800 text-lg leading-relaxed">
                    <span class="font-bold text-yellow-700 text-xl">Penerimaan Peserta Didik Baru (PPDB) Online</span>
                    adalah sistem yang dirancang untuk memudahkan proses penerimaan murid baru di
                    <span class="font-bold text-green-700 text-xl">MISBAHUNNUR CIMAHI</span>.
                  </p>
                </div>

                <div class="grid md:grid-cols-3 gap-6 mb-6">
                  <div
                    class="bg-green-50 p-5 rounded-xl text-center transform hover:scale-105 transition-all duration-300 shadow-md">
                    <i class="fas fa-tachometer-alt text-green-600 text-3xl mb-3"></i>
                    <h4 class="font-bold text-green-800 mb-2">EFISIEN</h4>
                    <p class="text-gray-700 text-sm">Proses lebih cepat dan mudah</p>
                  </div>

                  <div
                    class="bg-blue-50 p-5 rounded-xl text-center transform hover:scale-105 transition-all duration-300 shadow-md">
                    <i class="fas fa-eye text-blue-600 text-3xl mb-3"></i>
                    <h4 class="font-bold text-blue-800 mb-2">TRANSPARAN</h4>
                    <p class="text-gray-700 text-sm">Informasi jelas dan terbuka</p>
                  </div>

                  <div
                    class="bg-purple-50 p-5 rounded-xl text-center transform hover:scale-105 transition-all duration-300 shadow-md">
                    <i class="fas fa-check-double text-purple-600 text-3xl mb-3"></i>
                    <h4 class="font-bold text-purple-800 mb-2">AKURAT</h4>
                    <p class="text-gray-700 text-sm">Data terkelola dengan baik</p>
                  </div>
                </div>
              </div>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
              <div
                class="bg-gradient-to-br from-red-500 to-red-600 rounded-2xl shadow-xl p-6 text-white transform hover:-translate-y-2 transition-all duration-300">
                <div class="flex items-start space-x-4">
                  <div class="bg-white rounded-full p-3 flex-shrink-0">
                    <i class="fas fa-exclamation-triangle text-red-600 text-2xl"></i>
                  </div>
                  <div>
                    <h4 class="font-bold text-xl mb-2">PERHATIAN!</h4>
                    <p class="text-red-50 leading-relaxed">
                      Harap diperhatikan <span class="font-bold underline">pengisian data dengan benar</span>,
                      karena akan digunakan dalam seluruh proses PPDB.
                    </p>
                  </div>
                </div>
              </div>

              <div
                class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl shadow-xl p-6 text-white transform hover:-translate-y-2 transition-all duration-300">
                <div class="flex items-start space-x-4">
                  <div class="bg-white rounded-full p-3 flex-shrink-0">
                    <i class="fas fa-id-card text-blue-600 text-2xl"></i>
                  </div>
                  <div>
                    <h4 class="font-bold text-xl mb-2">NOMOR PENDAFTARAN</h4>
                    <p class="text-blue-50 leading-relaxed">
                      Setelah pengisian formulir berhasil, calon siswa akan mendapatkan
                      <span class="font-bold underline">nomor pendaftaran</span> yang
                      <span class="font-bold">WAJIB DISIMPAN</span> untuk proses selanjutnya.
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
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
    </main>


    @include('layouts.component.footer')
  </div>
  @filamentScripts
  @vite('resources/js/app.js')
</body>

</html>
