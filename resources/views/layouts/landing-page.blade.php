<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'PMB Misbahunnur Cimahi') }}</title>

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

        <main class="flex-grow">
            {{ $slot ?? '' }}
            @yield('content')
    </div>
    </main>


    @include('layouts.component.footer')
    </div>
    @filamentScripts
    @vite('resources/js/app.js')
</body>

</html>