<div class="max-w-4xl mx-auto py-6">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Export Data Siswa</h1>
        <p class="text-gray-600 text-sm mt-1">Unduh data pendaftaran siswa ke dalam format Excel berdasarkan Tahun dan
            Gelombang.</p>
    </div>

    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
        <div class="p-6 sm:p-8">

            <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-8 rounded-r">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-info-circle text-blue-500"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-blue-700">
                            Anda akan mengekspor data untuk jenjang <strong>{{ $jenjang }}</strong> dengan status
                            <strong>Diterima</strong> dan pembayaran <strong>Lunas</strong>.
                        </p>
                    </div>
                </div>
            </div>

            <form wire:submit.prevent="export" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- Filter Tahun --}}
                    <div>
                        <label for="tahun" class="block text-sm font-medium text-gray-700 mb-2">Tahun
                            Pendaftaran</label>
                        <div class="relative">
                            <select wire:model="tahun" id="tahun"
                                class="block w-full pl-3 pr-10 py-3 text-base border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm rounded-lg shadow-sm transition duration-150 ease-in-out">
                                <option value="">Pilih Tahun</option>
                                @foreach($availableYears as $year)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('tahun') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    {{-- Filter Gelombang --}}
                    <div>
                        <label for="gelombang" class="block text-sm font-medium text-gray-700 mb-2">Gelombang</label>
                        <div class="relative">
                            <select wire:model="gelombang" id="gelombang"
                                class="block w-full pl-3 pr-10 py-3 text-base border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm rounded-lg shadow-sm transition duration-150 ease-in-out">
                                <option value="">Pilih Gelombang</option>
                                @foreach($availableWaves as $wave)
                                    <option value="{{ $wave }}">Gelombang {{ $wave }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('gelombang') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="pt-4 border-t border-gray-100 flex items-center justify-end">

                    <div wire:loading wire:target="export" class="mr-4 text-gray-600 text-sm flex items-center">
                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-green-600" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                            </circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                        Sedang memproses file...
                    </div>

                    <button type="submit"
                        class="inline-flex items-center px-6 py-3 bg-green-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-800 focus:outline-none focus:border-green-800 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        <i class="fas fa-file-excel mr-2 text-lg"></i>
                        Download Excel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>