<x-guest-layout>
    <div class="min-h-screen flex flex-col justify-center items-center bg-gray-100 p-4">

        <div class="w-full max-w-md bg-green-800 rounded-2xl shadow-2xl overflow-hidden p-8 md:p-10">

            <div class="flex justify-center mb-6">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Aplikasi"
                    class="h-24 w-auto bg-white rounded-full p-3 shadow-md object-contain">
            </div>

            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-white">
                    {{ __('Login Admin') }}
                </h1>
                <p class="text-green-200 text-sm mt-2">Silakan masuk untuk melanjutkan</p>
            </div>

            <x-auth-session-status class="mb-4 text-white bg-green-600 p-3 rounded shadow"
                :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <div>
                    <x-input-label for="email" value="{{ __('Email') }}" class="text-green-100 ml-1" />
                    <x-text-input id="email"
                        class="block mt-1 w-full bg-white border-transparent focus:border-green-400 focus:ring-green-400 rounded-lg shadow-sm text-gray-800 py-3"
                        type="email" name="email" :value="old('email')" required autofocus
                        placeholder="admin@misbahunnur.com" />
                    <x-input-error :messages="$errors->get('email')"
                        class="mt-2 text-red-200 bg-red-900/30 p-2 rounded text-sm" />
                </div>

                <div>
                    <div class="flex items-center justify-between ml-1">
                        <x-input-label for="password" value="{{ __('Kata Sandi') }}" class="text-green-100" />
                    </div>

                    <x-text-input id="password"
                        class="block mt-1 w-full bg-white border-transparent focus:border-green-400 focus:ring-green-400 rounded-lg shadow-sm text-gray-800 py-3"
                        type="password" name="password" required autocomplete="current-password"
                        placeholder="············" />
                    <x-input-error :messages="$errors->get('password')"
                        class="mt-2 text-red-200 bg-red-900/30 p-2 rounded text-sm" />
                </div>

                <div class="pt-2">
                    <button type="submit"
                        class="w-full inline-flex items-center justify-center px-4 py-3 bg-green-600 border border-transparent rounded-lg font-bold text-sm text-white uppercase tracking-widest hover:bg-green-500 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-offset-2 focus:ring-offset-green-800 transition ease-in-out duration-150 shadow-lg transform hover:-translate-y-0.5">
                        {{ __('Masuk') }}
                    </button>
                </div>

                <div class="text-center mt-6 pt-4 border-t border-green-700">
                    <p class="text-sm text-green-200">
                        {{ __('Kembali ke') }}
                        <a href="{{ url('/') }}"
                            class="underline font-semibold text-white hover:text-green-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-green-800 focus:ring-green-500 rounded-md ml-1">
                            {{ __('Halaman Utama') }}
                        </a>
                    </p>
                </div>

            </form>
        </div>

        <div class="mt-8 text-gray-400 text-sm">
            &copy; {{ date('Y') }} Pondok Pesantren Misbahunnur
        </div>

    </div>
</x-guest-layout>