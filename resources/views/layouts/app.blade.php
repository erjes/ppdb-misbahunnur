<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'PPDB Misbahunnur Cimahi') }}</title>

  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

  <link rel="icon" type="image/x-icon" href="{{ asset('images/logo.png') }}">

  @filamentStyles
  @vite('resources/css/app.css')

  <style>
    body {
      background-repeat: repeat;
      background-size: contain;
    }

    .sidebar {
      transition: all 0.3s ease;
    }

    .sidebar-collapsed {
      width: 64px;
    }

    .sidebar-expanded {
      width: 250px;
    }

    .content-expanded {
      margin-left: 250px;
    }

    .content-collapsed {
      margin-left: 64px;
    }

    @media (max-width: 768px) {
      .sidebar {
        transform: translateX(-100%);
      }

      .sidebar-mobile-open {
        transform: translateX(0);
      }

      .content-expanded,
      .content-collapsed {
        margin-left: 0;
      }
    }
  </style>
</head>

<body class="font-sans antialiased text-gray-800 bg-white">
  <div class="min-h-screen flex">
    @auth
      @if (Auth::user()->role === 'admin')
        @include('layouts.component.admin-sidebar')
      @else
        @include('layouts.component.user-sidebar')
      @endif
    @else
      @include('layouts.component.user-sidebar')
    @endauth

    <div class="flex-1 flex flex-col">
      <header class="bg-white shadow-sm border-b border-gray-200">
        <div class="flex items-center justify-between px-6 py-4">
          <div class="flex items-center">
            <button @click="toggleSidebar" class="p-2 rounded-md text-gray-600 hover:bg-gray-100 lg:hidden">
              <i class="fa-solid fa-bars"></i>
            </button>
            <h1 class="text-xl font-semibold text-gray-800 ml-4">
              @yield('page-title', 'Dashboard')
            </h1>
          </div>

          <div class="flex items-center space-x-4">
            <x-dropdown align="right" width="48">
              <x-slot name="trigger">
                <button class="flex items-center space-x-2 text-sm font-medium text-gray-700 hover:text-gray-900">
                  <div class="text-right">
                    <div class="font-semibold">{{ Auth::user()->name }}</div>
                    <div class="text-xs text-gray-500">({{ strtoupper(Auth::user()->role) }})</div>
                  </div>
                  <i class="fa-solid fa-chevron-down text-xs"></i>
                </button>
              </x-slot>

              <x-slot name="content">
                <x-dropdown-link :href="route('profile.edit')">
                  <i class="fa-solid fa-user mr-2"></i>Profile
                </x-dropdown-link>
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                    <i class="fa-solid fa-right-from-bracket mr-2"></i>Log Out
                  </x-dropdown-link>
                </form>
              </x-slot>
            </x-dropdown>
          </div>
        </div>
      </header>

      <main class="flex-1 overflow-auto bg-gray-50">
        <div class="container mx-10 py-6">
          {{ $slot ?? '' }}
          @yield('content')
        </div>
      </main>
    </div>
  </div>

  @filamentScripts
  @vite('resources/js/app.js')

  <script>
    function toggleSidebar() {
      const sidebar = document.getElementById('sidebar');
      const content = document.getElementById('content');
      sidebar.classList.toggle('sidebar-mobile-open');
    }

    function toggleDesktopSidebar() {
      const sidebar = document.getElementById('sidebar');
      const content = document.getElementById('content');
      sidebar.classList.toggle('sidebar-collapsed');
      sidebar.classList.toggle('sidebar-expanded');
      content.classList.toggle('content-collapsed');
      content.classList.toggle('content-expanded');
    }
  </script>
</body>

</html>
