<x-guest-layout>
    <div class="min-h-screen flex flex-col justify-center items-center bg-gray-100 p-6 text-center">
        <div class="mb-6">
            <i class="fa-solid fa-circle-exclamation text-6xl text-green-600 opacity-80"></i>
        </div>

        <h1 class="text-8xl font-black text-green-900 mb-2">
            @yield('code')
        </h1>

        <h2 class="text-2xl font-bold text-gray-800 mb-4">
            @yield('title')
        </h2>

        <p class="text-gray-600 mb-8 max-w-lg mx-auto">
            @yield('message')
        </p>

        <a href="{{ url('/') }}"
            class="bg-green-600 hover:bg-green-700 text-white font-bold px-6 py-3 rounded-lg shadow transition-all">
            <i class="fa-solid fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>
</x-guest-layout>