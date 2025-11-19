<div class="max-w-4xl mx-auto py-6">
    <h1 class="text-2xl font-semibold mb-4">Pengaturan Biaya</h1>

    @if (session()->has('message'))
        <div class="mb-4 rounded bg-green-100 text-green-800 px-4 py-2 text-sm">
            {{ session('message') }}
        </div>
    @endif

    <div id="form-section" class="bg-white rounded-lg shadow p-5 mb-6">
        <h2 class="text-lg font-semibold mb-4">
            {{ $feeId ? 'Edit Biaya' : 'Tambah Biaya' }}
        </h2>

        <form wire:submit.prevent="save" class="space-y-4">
            <input type="hidden" wire:model="feeId">
        
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Nama Biaya
                </label>
                <input type="text"
                       id="nama_biaya"
                       wire:model="nama_biaya"
                       class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:ring focus:border-green-500">
                @error('nama_biaya')
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
        
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Jumlah (Rp)
                </label>
                <input type="number"
                       wire:model="jumlah"
                       step="1"
                       min="0"
                       class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:ring focus:border-green-500">
                @error('jumlah')
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
        
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Status
                </label>
                <select wire:model="aktif"
                        class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:ring focus:border-green-500">
                    <option value="1">Aktif</option>
                    <option value="0">Tidak Aktif</option>
                </select>
                @error('aktif')
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
        
            <div class="flex items-center space-x-2">
                <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-medium rounded hover:bg-green-700 transition">
                    {{ $feeId ? 'Simpan Perubahan' : 'Tambah Biaya' }}
                </button>
        
                @if ($feeId)
                    <button type="button"
                            wire:click="resetForm"
                            class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-800 text-sm font-medium rounded hover:bg-gray-300 transition">
                        Batal
                    </button>
                @endif
            </div>
        </form>
        
    </div>

    <div class="bg-white rounded-lg shadow p-5">
        <h2 class="text-lg font-semibold mb-4">Daftar Biaya</h2>

        @if ($fees->isEmpty())
            <p class="text-sm text-gray-500">Belum ada data biaya.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="border-b bg-gray-50">
                            <th class="px-4 py-2 text-left font-medium text-gray-700">Nama Biaya</th>
                            <th class="px-4 py-2 text-left font-medium text-gray-700">Jumlah</th>
                            <th class="px-4 py-2 text-left font-medium text-gray-700">Status</th>
                            <th class="px-4 py-2 text-left font-medium text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($fees as $fee)
                            <tr class="border-b last:border-0">
                                <td class="px-4 py-2">
                                    {{ $fee->nama_biaya }}
                                </td>
                                <td class="px-4 py-2">
                                    Rp {{ number_format($fee->jumlah, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-2">
                                    @if ($fee->aktif)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                            Aktif
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-red-100 text-red-800">
                                            Tidak Aktif
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-2 space-x-2">
                                    <button type="button"
                                            wire:click="edit({{ $fee->id }})"
                                            class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded bg-blue-600 text-white hover:bg-blue-700 transition">
                                        Edit
                                    </button>
                                
                                    <button type="button"
                                            onclick="if(!confirm('Yakin ingin menghapus biaya ini?')) return false;"
                                            wire:click="delete({{ $fee->id }})"
                                            class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded bg-red-600 text-white hover:bg-red-700 transition">
                                        Hapus
                                    </button>
                                </td>
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <script>
        document.addEventListener('livewire:initialized', () => {
            @this.on('scroll-to-form', () => {
                const formSection = document.getElementById('form-section');
                if (formSection) {
                    formSection.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
                
                const inputNama = document.getElementById('nama_biaya');
                if (inputNama) {
                    setTimeout(() => {
                        inputNama.focus();
                    }, 300); 
                }
            });
        });
    </script>
</div>