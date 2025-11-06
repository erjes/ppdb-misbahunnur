<nav x-data="{ open: false, infoOpen: false, infoOpenMobile: false, scrolled: false }"
    x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 10 })"
    :class="scrolled ? 'bg-green-900 py-2 shadow-2xl' : 'bg-green-800 py-4 shadow-lg'"
    class="fixed w-full top-0 left-0 z-50 border-b border-gray-100 transition-all duration-500 ease-in-out">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-12">

            <div class="flex items-center space-x-3 flex-shrink-0">
                <a href="{{ route('home') }}" class="flex items-center space-x-2">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo"
                        :class="scrolled ? 'h-7 w-7' : 'h-9 w-9'"
                        class="rounded-full transition-all duration-500">
                    <div class="flex flex-col leading-tight">
                        <h1 :class="scrolled ? 'text-base' : 'text-sm'"
                            class="text-white font-bold tracking-tight transition-all duration-500 whitespace-nowrap">
                            PPDB MISBAHUNNUR
                        </h1>
                        <h2 :class="scrolled ? 'text-xs' : 'text-xs'"
                            class="text-green-100 font-semibold uppercase transition-all duration-500 whitespace-nowrap">
                            Cimahi
                        </h2>
                    </div>
                </a>
            </div>

            <div class="hidden sm:flex items-center space-x-1 text-xs font-semibold text-white">
                <x-nav-link :href="route('admin.students.index')" :active="request()->routeIs('admin.students.*')">
                    <i class="fa-solid fa-user-graduate"></i> <span>SISWA</span>
                </x-nav-link>
                <x-nav-link :href="route('admin.documents.index')" :active="request()->routeIs('admin.documents.*')">
                    <i class="fa-solid fa-file-lines"></i> <span>DOKUMEN</span>
                </x-nav-link>
                <x-nav-link :href="route('admin.addresses.index')" :active="request()->routeIs('admin.addresses.*')">
                    <i class="fa-solid fa-location-dot"></i> <span>ALAMAT</span>
                </x-nav-link>
                <x-nav-link :href="route('admin.audios.index')" :active="request()->routeIs('admin.audios.*')">
                    <i class="fa-solid fa-headphones"></i> <span>AUDIO</span>
                </x-nav-link>
                <x-nav-link :href="route('admin.grades.index')" :active="request()->routeIs('admin.grades.*')">
                    <i class="fa-solid fa-clipboard-check"></i> <span>NILAI</span>
                </x-nav-link>
                <x-nav-link :href="route('admin.health-records.index')" :active="request()->routeIs('admin.health_records.*')">
                    <i class="fa-solid fa-notes-medical"></i> <span>KESEHATAN</span>
                </x-nav-link>
                <x-nav-link :href="route('admin.fees.index')" :active="request()->routeIs('admin.fees.*')">
                    <i class="fa-solid fa-money-bill"></i> <span>BIAYA</span>
                </x-nav-link>
                <x-nav-link :href="route('admin.payments.index')" :active="request()->routeIs('admin.payments.*')">
                    <i class="fa-solid fa-credit-card"></i> <span>PEMBAYARAN</span>
                </x-nav-link>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-gray-800 bg-white hover:bg-gray-100 focus:outline-none transition ease-in-out duration-150">
                                <div class="text-center">
                                    <div class="font-semibold leading-tight">{{ Auth::user()->name }}</div>
                                    <div class="text-xs text-gray-500">({{ strtoupper(Auth::user()->role) }})</div>
                                </div>
                                <svg class="ml-2 h-4 w-4 text-gray-600" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
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
                    class="inline-flex items-center justify-center p-2 rounded-md text-white hover:bg-green-700 focus:outline-none transition-all duration-300">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden bg-green-700 transition-all duration-500">
        <div class="pt-2 pb-3 space-y-1 text-white text-sm font-semibold">
            <x-responsive-nav-link :href="route('admin.students.index')" :active="request()->routeIs('admin.students.*')">
                <i class="fa-solid fa-user-graduate"></i> STUDENTS
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.documents.index')" :active="request()->routeIs('admin.documents.*')">
                <i class="fa-solid fa-file-lines"></i> DOKUMEN
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.addresses.index')" :active="request()->routeIs('admin.addresses.*')">
                <i class="fa-solid fa-location-dot"></i> ALAMAT
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.audios.index')" :active="request()->routeIs('admin.audios.*')">
                <i class="fa-solid fa-headphones"></i> AUDIO
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.grades.index')" :active="request()->routeIs('admin.grades.*')">
                <i class="fa-solid fa-clipboard-check"></i> NILAI
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.health-records.index')" :active="request()->routeIs('admin.health_records.*')">
                <i class="fa-solid fa-notes-medical"></i> KESEHATAN
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.fees.index')" :active="request()->routeIs('admin.fees.*')">
                <i class="fa-solid fa-money-bill"></i> BIAYA
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.payments.index')" :active="request()->routeIs('admin.payments.*')">
                <i class="fa-solid fa-credit-card"></i> PEMBAYARAN
            </x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-1 border-t border-green-600">
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
