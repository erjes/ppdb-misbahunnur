<div class="mx-auto">
    <h1 class="text-2xl font-bold mb-6">Pengaturan Pendaftaran</h1>

    @if (session()->has('message'))
        <div class="mb-4 rounded bg-green-100 text-green-800 px-4 py-2 text-sm">
            {{ session('message') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow p-6 space-y-6">
        <div>
            <h2 class="text-lg font-semibold mb-1">Informasi Formulir</h2>
            <p class="text-sm text-gray-500">
                Form: <span class="font-semibold">{{ $form->name }}</span>
            </p>
        </div>

        <form wire:submit.prevent="save" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Tahun Formulir
                </label>
                <input type="number" wire:model="tahun"
                    class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:ring focus:border-green-500">
                @error('tahun')
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Gelombang Pendaftaran Aktif
                </label>
                <select wire:model="gelombang_aktif"
                    class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:ring focus:border-green-500">
                    @for ($i = 1; $i <= 3; $i++)
                        <option value="{{ $i }}">Gelombang {{ $i }}</option>
                    @endfor
                </select>
                @error('gelombang_aktif')
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Status Pendaftaran
                </label>
                <div class="flex items-center space-x-3">
                    @if ($is_open)
                        <span
                            class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                            Dibuka
                        </span>
                    @else
                        <span
                            class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800">
                            Ditutup
                        </span>
                    @endif

                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox" wire:model="is_open" class="rounded text-green-700 focus:ring-green-500"
                            @if ($is_open) checked @endif>
                        <span class="text-black font-semibold">
                            {{ 'Buka Pendaftaran' }}
                        </span>
                    </label>

                </div>
            </div>

            <div class="pt-4 border-t flex justify-end">
                <button type="submit" wire:loading.attr="disabled" wire:target="save"
                    class="px-4 py-2 bg-green-600 text-white text-sm font-medium rounded hover:bg-green-700 transition flex items-center disabled:opacity-50 disabled:cursor-not-allowed">

                    <span wire:loading.remove wire:target="save">
                        Simpan Pengaturan
                    </span>

                    <span wire:loading wire:target="save" class="flex items-center">
                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                            </circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                        Menyimpan...
                    </span>
                </button>
            </div>
        </form>
    </div>
</div>