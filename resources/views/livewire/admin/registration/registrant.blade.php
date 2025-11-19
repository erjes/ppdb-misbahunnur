<div>
  <div class="mb-6 flex justify-between items-end">
    <div>
      <h1 class="text-2xl font-bold text-gray-800 mb-2">Data Pendaftaran Siswa</h1>
      <p class="text-sm text-gray-600">Kelola dan pantau pendaftaran siswa baru</p>
    </div>

    <div class="flex items-center gap-3">
      <div wire:loading class="flex items-center text-green-600 text-sm font-medium">
        <svg class="animate-spin h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
          <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
          <path class="opacity-75" fill="currentColor"
            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
          </path>
        </svg>
        Memuat data...
      </div>

      {{-- Input Pencarian --}}
      <div class="w-full max-w-xs">
        <div class="relative">
          <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <i class="fas fa-search text-gray-400"></i>
          </div>
          <input type="text" wire:model.live.debounce.300ms="search"
            class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-green-500 focus:border-green-500 sm:text-sm"
            placeholder="Cari Nama / No. Pendaftaran...">
        </div>
      </div>
    </div>
  </div>

  <div class="bg-white rounded-lg shadow-lg overflow-hidden border border-gray-200">
    <div class="overflow-x-auto" wire:loading.class="opacity-50 pointer-events-none">
      <table class="w-full min-w-full divide-y divide-gray-200">
        <thead class="bg-gradient-to-r from-green-600 to-green-700">
          <tr>
            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
              No
            </th>
            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
              Nomor Pendaftaran
            </th>
            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
              Nama Lengkap
            </th>
            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
              Jenis Kelamin
            </th>
            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
              Status Dokumen
            </th>
            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
              Status Pembayaran
            </th>
            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
              Jenjang Pendaftaran
            </th>
            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
              Jalur Pendaftaran
            </th>
            <th class="px-6 py-4 text-center text-xs font-semibold text-white uppercase tracking-wider">
              Action
            </th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          @forelse ($students as $index => $student)
            <tr class="hover:bg-green-50 transition-colors duration-200">
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                {{ $index + 1 }}
              </td>

              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <div class="flex-shrink-0 h-10 w-10 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-id-card text-green-600"></i>
                  </div>
                  <div class="ml-3">
                    <p class="text-sm font-medium text-gray-900">
                      {{ $student->nomor_pendaftaran }}
                    </p>
                  </div>
                </div>
              </td>

              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm font-medium text-gray-900">
                  {{ $student->nama_lengkap }}
                </div>
              </td>

              <td class="px-6 py-4 whitespace-nowrap">
                @if ($student->jenis_kelamin == 'L')
                  <span
                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                    <i class="fas fa-mars mr-1.5"></i>
                    Laki-Laki
                  </span>
                @else
                  <span
                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-pink-100 text-pink-800">
                    <i class="fas fa-venus mr-1.5"></i>
                    Perempuan
                  </span>
                @endif
              </td>

              <td class="px-6 py-4 whitespace-nowrap">
                @php
                  $status = $student->registration->status ?? 'Pending';
                  $statusClass = match ($status) {
                    'approved' => 'bg-green-100 text-green-800',
                    'rejected' => 'bg-red-100 text-red-800',
                    default => 'bg-yellow-100 text-yellow-800',
                  };
                  $statusIcon = match ($status) {
                    'approved' => 'fa-check-circle',
                    'rejected' => 'fa-times-circle',
                    default => 'fa-clock',
                  };
                  $statusLabel = match ($status) {
                    'approved' => 'Disetujui',
                    'rejected' => 'Ditolak',
                    default => 'Menunggu',
                  };
                @endphp

                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $statusClass }}">
                  <i class="fas {{ $statusIcon }} mr-1.5"></i>
                  {{ $statusLabel }}
                </span>
              </td>

              <td class="px-6 py-4 whitespace-nowrap">
                @if ($student->registration->is_paid)
                  <span
                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                    <i class="fas fa-check-circle mr-1.5"></i>
                    Lunas
                  </span>
                @else
                  <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                    <i class="fas fa-times-circle mr-1.5"></i>
                    Belum Lunas
                  </span>
                @endif
              </td>


              <td class="px-6 py-4 whitespace-nowrap">
                <span
                  class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                  <i class="fas fa-graduation-cap mr-1.5"></i>
                  {{ $student->registration->jenjang_daftar ?? 'Pending' }}
                </span>
              </td>


              <td class="px-6 py-4 whitespace-nowrap">
                <span
                  class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                  <i class="fas fa-route mr-1.5"></i>
                  {{ $student->registration->jalur_daftar ?? 'Pending' }}
                </span>
              </td>

              <td class="px-6 py-4 whitespace-nowrap text-center">
                <div class="flex items-center justify-center space-x-2">
                  <a href="{{ route('admin.registrations.documents', $student->id) }}"
                    class="inline-flex items-center px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-medium rounded-lg transition-all duration-200 shadow-sm hover:shadow-md">
                    <i class="fas fa-file-alt mr-1.5"></i>
                    Dokumen
                  </a>
                  <a href="{{ route('admin.payments.verify', $student->id) }}"
                    class="inline-flex items-center px-3 py-2 bg-yellow-600 hover:bg-yellow-700 text-white text-xs font-medium rounded-lg transition-all duration-200 shadow-sm hover:shadow-md">
                    <i class="fas fa-credit-card mr-1.5"></i>
                    Pembayaran
                  </a>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="9" class="px-6 py-12 text-center">
                <div class="flex flex-col items-center justify-center">
                  <i class="fas fa-inbox text-gray-300 text-5xl mb-3"></i>
                  <p class="text-gray-500 font-medium">Tidak ada data ditemukan</p>
                  <p class="text-gray-400 text-sm mt-1">Coba kata kunci pencarian lain.</p>
                </div>
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
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