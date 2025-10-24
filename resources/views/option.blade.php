@extends('layouts.app')

@section('content')
    {{-- @include('layouts.user-navigation') --}}

    <section class="py-10 bg-[url('/images/bg-pattern.png')] bg-cover">
        <div class="container mx-auto text-center px-6">
            <h2 class="text-3xl font-bold text-green-800 mb-6">ALUR DAFTAR ULANG</h2>
            <p class="text-green-900 font-semibold bg-green-100 inline-block px-4 py-2 rounded">
                CALON PESERTA DIDIK BARU YANG DINYATAKAN LULUS SELEKSI HARUS SEGERA MELAKSANAKAN PROSES DAFTAR ULANG SEBAGAI
                BERIKUT
            </p>

            <div class="grid md:grid-cols-3 lg:grid-cols-6 gap-6 mt-12 text-left">
                <div class="flex flex-col items-center">
                    <div
                        class="bg-green-600 text-white w-14 h-14 flex items-center justify-center rounded-full text-xl font-bold">
                        1</div>
                    <p class="mt-4 text-sm text-gray-700 text-center">Tata cara daftar ulang online dapat diakses di website
                        resmi.</p>
                </div>

                <div class="flex flex-col items-center">
                    <div
                        class="bg-green-600 text-white w-14 h-14 flex items-center justify-center rounded-full text-xl font-bold">
                        2</div>
                    <p class="mt-4 text-sm text-gray-700 text-center">Mengisi data peserta didik baru secara online dan
                        menyerahkan printout-nya saat daftar ulang.</p>
                </div>

                <div class="flex flex-col items-center">
                    <div
                        class="bg-yellow-500 text-white w-14 h-14 flex items-center justify-center rounded-full text-xl font-bold">
                        3</div>
                    <p class="mt-4 text-sm text-gray-700 text-center">Menyerahkan berkas daftar ulang ke panitia pada waktu
                        yang telah dijadwalkan.</p>
                </div>

                <div class="flex flex-col items-center">
                    <div
                        class="bg-yellow-500 text-white w-14 h-14 flex items-center justify-center rounded-full text-xl font-bold">
                        4</div>
                    <p class="mt-4 text-sm text-gray-700 text-center">Menandatangani surat pernyataan peraturan calon
                        peserta didik.</p>
                </div>

                <div class="flex flex-col items-center">
                    <div
                        class="bg-blue-600 text-white w-14 h-14 flex items-center justify-center rounded-full text-xl font-bold">
                        5</div>
                    <p class="mt-4 text-sm text-gray-700 text-center">Menyerahkan Surat Keterangan Lulus (SKL).</p>
                </div>

                <div class="flex flex-col items-center">
                    <div
                        class="bg-orange-500 text-white w-14 h-14 flex items-center justify-center rounded-full text-xl font-bold">
                        6</div>
                    <p class="mt-4 text-sm text-gray-700 text-center">Calon peserta didik baru yang lolos verifikasi
                        mengikuti kegiatan MATSAMA.</p>
                </div>
            </div>
        </div>
    </section>
@endsection