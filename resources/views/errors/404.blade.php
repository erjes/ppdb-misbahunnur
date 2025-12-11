<x-guest-layout>
    <div class="min-h-screen flex flex-col justify-center items-center bg-gray-100 p-6 text-center">

        {{-- Icon / Ilustrasi --}}
        <div class="mb-6 animate-bounce">
            <i class="fa-solid fa-triangle-exclamation text-7xl text-green-600"></i>
        </div>

        {{-- Kode Error --}}
        <h1 class="text-9xl font-extrabold text-green-800 drop-shadow-sm tracking-widest">
            404
        </h1>

        {{-- Pesan Error --}}
        <div class="px-4 py-1 text-sm rounded">
            <span class="text-black font-bold">Halaman Tidak Ditemukan</span>
        </div>

        <p class="mt-8 text-lg text-gray-600 font-medium max-w-md mx-auto">
            Maaf, halaman yang Anda cari tidak dapat ditemukan atau telah dipindahkan.
        </p>

        <div class="mt-8">
            <a href="{{ url('/') }}"
                class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-full text-white bg-green-700 hover:bg-green-800 transition duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                <i class="fa-solid fa-house mr-2"></i>
                Kembali ke Beranda
            </a>
        </div>

        <div class="mt-12 text-sm text-gray-400">
            &copy; {{ date('Y') }} Pondok Pesantren Misbahunnur
        </div>
    </div>
</x-guest-layout>