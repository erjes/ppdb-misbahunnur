<x-guest-layout>
    <div class="min-h-screen bg-gray-100 flex flex-col items-center justify-center p-8 md:p-12">
        <div class="w-full bg-green-800 p-8 rounded-lg shadow-md">
            <div class="flex justify-center mb-6">
                <a href="/">
                    <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name', 'Laravel') }} logo"
                        class="h-16 w-auto rounded-full"> {{-- Smaller size: h-16 --}}
                </a>
            </div>

            <h1 class="text-3xl font-bold text-white mb-2 text-center md:text-left">
                {{ __('Formulir Pendaftaran Siswa') }}
            </h1>
            <p class="text-sm text-green-200 mb-8 text-center md:text-left">
                {{ __('Lengkapi data berikut untuk mendaftar') }}
            </p>

            <form method="POST" action="{{ route('daftar.store') }}" enctype="multipart/form-data">
                @csrf

                <h2 class="text-xl font-semibold text-white border-b border-green-600 pb-2 mb-4">Data Calon Siswa</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <x-input-label for="nisn" value="{{ __('NISN') }}" class="text-green-100" />
                        <x-text-input id="nisn"
                            class="block mt-1 w-full bg-white border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm text-gray-700"
                            type="text" name="nisn" :value="old('nisn')" required autofocus
                            placeholder="Nomor Induk Siswa Nasional" />
                        <x-input-error :messages="$errors->get('nisn')" class="mt-2 text-red-300" />
                    </div>
                    <div>
                        <x-input-label for="nik" value="{{ __('NIK Siswa') }}" class="text-green-100" />
                        <x-text-input id="nik"
                            class="block mt-1 w-full bg-white border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm text-gray-700"
                            type="text" name="nik" :value="old('nik')" placeholder="Nomor Induk Kependudukan" />
                        <x-input-error :messages="$errors->get('nik')" class="mt-2 text-red-300" />
                    </div>
                </div>

                <div class="mt-4">
                    <x-input-label for="nama" value="{{ __('Nama Lengkap Siswa') }}" class="text-green-100" />
                    <x-text-input id="nama"
                        class="block mt-1 w-full bg-white border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm text-gray-700"
                        type="text" name="nama" :value="old('nama')" required placeholder="Sesuai Akta Kelahiran" />
                    <x-input-error :messages="$errors->get('nama')" class="mt-2 text-red-300" />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                    <div>
                        <x-input-label for="tempat_lahir" value="{{ __('Tempat Lahir') }}" class="text-green-100" />
                        <x-text-input id="tempat_lahir"
                            class="block mt-1 w-full bg-white border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm text-gray-700"
                            type="text" name="tempat_lahir" :value="old('tempat_lahir')"
                            placeholder="Kota/Kabupaten Kelahiran" />
                        <x-input-error :messages="$errors->get('tempat_lahir')" class="mt-2 text-red-300" />
                    </div>
                    <div>
                        <x-input-label for="tgl_lahir" value="{{ __('Tanggal Lahir') }}" class="text-green-100" />
                        <x-text-input id="tgl_lahir"
                            class="block mt-1 w-full bg-white border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm text-gray-700"
                            type="date" name="tgl_lahir" :value="old('tgl_lahir')" />
                        <x-input-error :messages="$errors->get('tgl_lahir')" class="mt-2 text-red-300" />
                    </div>
                </div>

                <div class="mt-4">
                    <x-input-label for="jenkel" value="{{ __('Jenis Kelamin') }}" class="text-green-100" />
                    <select id="jenkel" name="jenkel"
                        class="block mt-1 w-full bg-white border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm text-gray-700">
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="L" {{ old('jenkel') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('jenkel') == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    <x-input-error :messages="$errors->get('jenkel')" class="mt-2 text-red-300" />
                </div>

                <div class="mt-4">
                    <x-input-label for="asal_sekolah" value="{{ __('Asal Sekolah') }}" class="text-green-100" />
                    <x-text-input id="asal_sekolah"
                        class="block mt-1 w-full bg-white border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm text-gray-700"
                        type="text" name="asal_sekolah" :value="old('asal_sekolah')"
                        placeholder="Nama SMP/MTs/Sederajat" />
                    <x-input-error :messages="$errors->get('asal_sekolah')" class="mt-2 text-red-300" />
                </div>

                <h2 class="text-xl font-semibold text-white border-b border-green-600 pb-2 mt-6 mb-4">Pilihan
                    Pendaftaran</h2>

                <div class="mt-4">
                    <x-input-label for="jurusan_id" value="{{ __('Jenjang/Jurusan Tujuan') }}" class="text-green-100" />
                    <select id="jurusan_id" name="jurusan_id"
                        class="block mt-1 w-full bg-white border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm text-gray-700">
                        <option value="">Pilih Jenjang/Jurusan</option>

                    </select>
                    <x-input-error :messages="$errors->get('jurusan_id')" class="mt-2 text-red-300" />
                </div>


                <div class="mt-8 flex justify-end">
                    <button type="submit"
                        class="inline-flex items-center px-6 py-3 bg-green-600 border border-transparent rounded-md font-semibold text-sm text-white capitalize tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 focus:ring-offset-green-800 transition ease-in-out duration-150">
                        {{ __('Kirim Pendaftaran') }}
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
</x-guest-layout>