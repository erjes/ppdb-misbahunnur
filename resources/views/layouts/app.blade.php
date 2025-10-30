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


    @vite(['resources/css/app.css', 'resources/js/app.js'])

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
            @auth
                @if(Auth::user()->role === 'admin')
                    @include('layouts.navigation')
                @else
                    @include('layouts.user-navigation')
                @endif
            @else
                @include('layouts.user-navigation')
            @endauth
        </header>

        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <main class="flex-grow">
            {{ $slot ?? '' }}
            @yield('content')
        </main>

        <footer class="bg-green-900 text-white py-8">
            <div class="container mx-auto px-6 lg:px-8 text-center md:text-left">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div>
                        <h3 class="text-lg font-semibold mb-3">Kontak Kami</h3>
                        <p class="text-sm text-green-200 mb-1">PPDB Online © MISBAHUNNUR CIMAHI</p>
                        <p class="text-sm text-green-200">
                            Jl. Kolonel Masturi No. 139 Cipageran<br>
                            Kec Cimahi Utara, Cimahi 40511
                        </p>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold mb-3">Info Lebih Lanjut</h3>
                        <p class="text-sm text-green-200 mb-1">
                            <span class="font-medium">Telepon:</span>
                            <a href="tel:0226632371" class="hover:text-green-100">(022) 6632371</a>
                        </p>
                        <p class="text-sm text-green-200 mb-1">
                            <span class="font-medium">Email:</span>
                            <a href="mailto:humasmisbahunnur@gmail.com"
                                class="hover:text-green-100">humasmisbahunnur@gmail.com</a>
                        </p>
                        <p class="text-sm text-green-200">
                            <span class="font-medium">Website:</span>
                            <a href="https://misbahunnur.ponpes.id/" target="_blank" rel="noopener noreferrer"
                                class="hover:text-green-100">misbahunnur.ponpes.id</a>
                        </p>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold mb-3">Tautan Cepat</h3>
                        <ul class="space-y-1 text-sm">
                            <li><a href="{{ url('/') }}" class="text-green-200 hover:text-white">Beranda</a></li>
                            <li><a href="{{ route('login.siswa') }}" class="text-green-200 hover:text-white">Login Siswa</a>
                            </li>
                            <li><a href="{{ route('login') }}" class="text-green-200 hover:text-white">Login
                                    Admin</a></li>
                        </ul>
                    </div>

                </div>
                <div id="kontak" class="border-t border-green-700 mt-8 pt-6 text-center text-sm text-green-300">
                    <p>&copy; {{ date('Y') }} PPDB Misbahunnur Cimahi. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>

</body>

</html>