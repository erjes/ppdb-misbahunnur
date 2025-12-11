<x-guest-layout>
    <div class="min-h-screen flex flex-col justify-center items-center bg-gray-100 p-6 text-center">

        {{-- Icon / Ilustrasi --}}
        <div class="mb-6 animate-pulse">
            <i class="fa-solid fa-user-lock text-7xl text-green-600"></i>
        </div>

        {{-- Kode Error --}}
        <h1 class="text-9xl font-extrabold text-green-800 drop-shadow-sm tracking-widest">
            401
        </h1>

        {{-- Pesan Error --}}
        <div
            class="bg-green-600 px-4 py-1 text-sm rounded rotate-12 absolute shadow-md transform translate-y-12 translate-x-12">
            <span class="text-white font-bold">Tidak Terautentikasi</span>
        </div>

        <h2 class="mt-8 text-2xl font-bold text-gray-800">
            Akses Dibatasi
        </h2>

        <p class="mt-4 text-lg text-gray-600 font-medium max-w-md mx-auto">
            Maaf, sesi Anda telah berakhir atau Anda belum login. Silakan masuk kembali untuk melanjutkan akses.
        </p>

        <div class="mt-8">
            <a href="{{ route('login') }}"
                class="inline-flex items-center px-8 py-3 border border-transparent text-base font-bold rounded-full text-white bg-green-700 hover:bg-green-800 transition duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                <i class="fa-solid fa-right-to-bracket mr-2"></i>
                Masuk Sekarang
            </a>
        </div>

        <div class="mt-12 text-sm text-gray-400">
            &copy; {{ date('Y') }} Pondok Pesantren Misbahunnur
        </div>
    </div>
</x-guest-layout>