<div>
  <div class="mb-6">
    <div class="flex items-center justify-between mb-4">
      <div>
        <h1 class="text-2xl font-bold text-gray-800 flex items-center">
          <i class="fas fa-user-graduate text-green-600 mr-3"></i>
          Data Pendaftar MA
        </h1>
        <p class="text-sm text-gray-600 mt-1">Kelola data siswa Madrasah Aliyah</p>
      </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm p-4 border border-gray-200">
      <div class="flex flex-wrap items-center gap-3">
        <div class="flex-1 min-w-[260px]">
          <div class="relative">
            <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            <input type="text" placeholder="Cari nama/nomor/NISN/NIK" wire:model.debounce.400ms="search"
              class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200">
          </div>
        </div>

        <select wire:model="perPage"
          class="px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200 bg-white">
          <option value="10">10 / halaman</option>
          <option value="25">25 / halaman</option>
          <option value="50">50 / halaman</option>
          <option value="100">100 / halaman</option>
        </select>

        <a href="{{ route('admin.students.export', 'MA') }}?q={{ urlencode($search) }}&sort={{ $sortField }}&dir={{ $sortDirection }}"
          class="inline-flex items-center px-4 py-2.5 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-all duration-200 shadow-sm hover:shadow-md ml-auto">
          <i class="fas fa-download mr-2"></i>
          Export Excel
        </a>
      </div>
    </div>
  </div>

  <div class="bg-white rounded-lg shadow-lg overflow-hidden border border-gray-200">
    <div class="overflow-x-auto">
      <table class="w-full min-w-full divide-y divide-gray-200">
        <thead class="bg-gradient-to-r from-green-600 to-green-700">
          <tr>
            <th class="px-6 py-4 text-left">
              <button wire:click="sortBy('students.nomor_pendaftaran')"
                class="flex items-center text-xs font-semibold text-white uppercase tracking-wider hover:text-green-100 transition-colors">
                No. Pendaftaran
                <i class="fas fa-sort ml-2 text-green-200"></i>
              </button>
            </th>
            <th class="px-6 py-4 text-left">
              <button wire:click="sortBy('students.nama_lengkap')"
                class="flex items-center text-xs font-semibold text-white uppercase tracking-wider hover:text-green-100 transition-colors">
                Nama
                <i class="fas fa-sort ml-2 text-green-200"></i>
              </button>
            </th>
            <th class="px-6 py-4 text-left">
              <button wire:click="sortBy('students.nisn')"
                class="flex items-center text-xs font-semibold text-white uppercase tracking-wider hover:text-green-100 transition-colors">
                NISN
                <i class="fas fa-sort ml-2 text-green-200"></i>
              </button>
            </th>
            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
              NIK
            </th>
            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
              Status Pembayaran
            </th>
            <th class="px-6 py-4 text-left">
              <button wire:click="sortBy('students.created_at')"
                class="flex items-center text-xs font-semibold text-white uppercase tracking-wider hover:text-green-100 transition-colors">
                Tanggal Pendaftaran
                <i class="fas fa-sort ml-2 text-green-200"></i>
              </button>
            </th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          @forelse($rows as $row)
            <tr class="hover:bg-green-50 transition-colors duration-200">
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <div class="flex-shrink-0 h-10 w-10 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-id-card text-green-600"></i>
                  </div>
                  <div class="ml-3">
                    <p class="text-sm font-medium text-gray-900">
                      {{ $row->nomor_pendaftaran }}
                    </p>
                  </div>
                </div>
              </td>

              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm font-medium text-gray-900">
                  {{ $row->nama_lengkap }}
                </div>
              </td>

              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-700 font-mono bg-gray-50 px-3 py-1 rounded inline-block">
                  {{ $row->nisn }}
                </div>
              </td>

              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-700 font-mono bg-gray-50 px-3 py-1 rounded inline-block">
                  {{ $row->nik_siswa }}
                </div>
              </td>

              <td class="px-6 py-4 whitespace-nowrap">
                @if ($row->is_paid)
                  <span
                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                    <i class="fas fa-check-circle mr-1.5"></i>
                    Lunas
                  </span>
                @else
                  <span
                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                    <i class="fas fa-times-circle mr-1.5"></i>
                    Belum Lunas
                  </span>
                @endif
              </td>

              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center text-sm text-gray-700">
                  <i class="fas fa-calendar-alt text-gray-400 mr-2"></i>
                  {{ $row->created_at?->format('d M Y') }}
                  <span class="text-gray-500 ml-2">{{ $row->created_at?->format('H:i') }}</span>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="px-6 py-12 text-center">
                <div class="flex flex-col items-center justify-center">
                  <i class="fas fa-inbox text-gray-300 text-5xl mb-3"></i>
                  <p class="text-gray-500 font-medium">Tidak ada data</p>
                  <p class="text-gray-400 text-sm mt-1">Belum ada siswa yang terdaftar</p>
                </div>
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
      {{ $rows->links() }}
    </div>
  </div>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

  <style>
    .overflow-x-auto::-webkit-scrollbar {
      height: 8px;
    }

    .overflow-x-auto::-webkit-scrollbar-track {
      background: #f1f5f9;
      border-radius: 4px;
    }

    .overflow-x-auto::-webkit-scrollbar-thumb {
      background: #16a34a;
      border-radius: 4px;
    }

    .overflow-x-auto::-webkit-scrollbar-thumb:hover {
      background: #15803d;
    }
  </style>
</div>
