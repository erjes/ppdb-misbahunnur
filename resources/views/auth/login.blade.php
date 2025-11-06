
<x-guest-layout>
    <div class="flex flex-col md:flex-row min-h-screen">

        <div class="hidden md:flex md:w-1/2 bg-gray-100 items-center justify-center p-12">
            <div class="max-w-md">
                <img src="{{ asset('images/logo.png') }}" alt="Ilustrasi Login Admin" class="w-full h-auto">
            </div>
        </div>

        <div class="w-full md:w-1/2 bg-green-800 flex items-center justify-center p-8 md:p-12">
            <div class="w-full max-w-sm">

                <h1 class="text-3xl font-bold text-white mb-2 text-center md:text-left">
                    {{ __('Login Admin') }}
                </h1>
                <x-auth-session-status class="mb-4 text-white bg-green-600 p-3 rounded" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div>
                        <x-input-label for="email" value="{{ __('Email') }}" class="text-green-100" />
                        <x-text-input id="email"
                            class="block mt-1 w-full bg-white border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm text-gray-700"
                            type="email" name="email" :value="old('email')" required autofocus
                            placeholder="Masukkan email admin" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-300" />
                    </div>

                    <div class="mt-4">
                        <div class="flex items-center justify-between">
                            <x-input-label for="password" value="{{ __('Kata Sandi') }}" class="text-green-100" />
                        </div>

                        <x-text-input id="password"
                            class="block mt-1 w-full bg-white border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm text-gray-700"
                            type="password" name="password" required autocomplete="current-password"
                            placeholder="············" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-300" />
                    </div>

                    <div class="mt-6">
                        <button type="submit"
                            class="w-full inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-sm text-white capitalize tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 focus:ring-offset-green-800 transition ease-in-out duration-150">
                            {{ __('Masuk') }}
                        </button>
                    </div>

                    <div class="text-center mt-4">
                        <p class="text-sm text-green-200">
                            {{ __('Kembali ke') }}
                            <a href="{{ url('/') }}"
                                class="underline font-semibold text-white hover:text-green-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-green-800 focus:ring-green-500 rounded-md">
                                {{ __('Halaman Utama') }}
                            </a>
                        </p>
                    </div>

                </form>
            </div>
        </div>

    </div>
</x-guest-layout>