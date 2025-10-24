<nav x-data="{ open: false, infoOpen: false, infoOpenMobile: false, scrolled: false }"
    x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 10 })"
    :class="scrolled ? 'bg-green-900 py-2 shadow-2xl' : 'bg-green-800 py-4 shadow-lg'"
    class="fixed w-full top-0 left-0 z-50 border-b border-gray-100 transition-all duration-500 ease-in-out">
    <div class="max-w-7xl mx-auto px-6 sm:px-4 lg:px-8">
        <div class="flex justify-between h-10">
            <div class="flex items-center space-x-6 transition-all duration-300">
                <a href="{{ route('home') }}" class="flex items-center space-x-2">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" :class="scrolled ? 'h-8 w-8' : 'h-10 w-10'"
                        class="rounded-full transition-all duration-500">
                    <h1 :class="scrolled ? 'text-lg' : 'text-2xl'"
                        class="text-white font-bold transition-all duration-500">{{ config('app.name', 'Laravel') }}
                    </h1>
                </a>
                <div class="hidden sm:flex items-center space-x-6 text-sm font-semibold">
                    <x-nav-link href="#alur" :active="request()->routeIs('#alur')">
                        <i class="fa-solid fa-shuffle"></i><span>ALUR</span>
                    </x-nav-link>
                    <x-nav-link href="#syarat" :active="request()->routeIs('#syarat')">
                        <i class="fa-solid fa-shuffle"></i><span>SYARAT</span>
                    </x-nav-link>
                    <x-nav-link href="#kontak" :active="request()->routeIs('#kontak')">
                        <i class="fa-solid fa-shuffle"></i><span>KONTAK</span>
                    </x-nav-link>
                </div>
            </div>
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:text-gray-900 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }} ({{ strtoupper(Auth::user()->role) }})</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">Profile</x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    Log Out
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endauth
            </div>
            <div class="flex items-center sm:hidden">
                <button @click="open = !open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-white hover:bg-green-700 focus:outline-none focus:bg-green-700 transition-all duration-300">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden bg-green-700 transition-all duration-500">
        <div class="pt-2 pb-3 space-y-1 text-white text-sm font-semibold">
            <x-responsive-nav-link href="#alur" :active="request()->routeIs('#alur')">
                <i class="fa-solid fa-shuffle"></i> ALUR
            </x-responsive-nav-link>
            <x-responsive-nav-link href="#syarat" :active="request()->routeIs('#syarat')">
                <i class="fa-solid fa-shuffle"></i> SYARAT
            </x-responsive-nav-link>
            <x-responsive-nav-link href="#kontak" :active="request()->routeIs('#kontak')">
                <i class="fa-solid fa-shuffle"></i> KONTAK
            </x-responsive-nav-link>
        </div>
        <div class="pt-4 pb-1 border-t border-green-500">
            @auth
                <div class="px-4">
                    <div class="font-medium">{{ Auth::user()->name }}</div>
                    <div class="text-sm text-green-100">{{ Auth::user()->email }}</div>
                </div>
                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">Profile</x-responsive-nav-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            Log Out
                        </x-responsive-nav-link>
                    </form>
                </div>
            @else
                <x-responsive-nav-link :href="route('login')">Login</x-responsive-nav-link>
                @if (Route::has('register'))
                    <x-responsive-nav-link :href="route('register')">Register</x-responsive-nav-link>
                @endif
            @endauth
        </div>
    </div>
</nav>