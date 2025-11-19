<div>
  <div class="mb-6">
    <div class="flex flex-wrap items-center gap-3">

      <div class="flex-1 min-w-[260px]">
        <div class="relative">
          <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
          <input type="text" placeholder="Cari nama/nomor/NISN/NIK" wire:model.live.debounce.400ms="search"
            class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200">
        </div>
      </div>

      <select wire:model.live="perPage"
        class="px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200 bg-white">
        <option value="10">10 / halaman</option>
        <option value="25">25 / halaman</option>
        <option value="50">50 / halaman</option>
        <option value="100">100 / halaman</option>
      </select>

      <div>
        <label for="tahunFilter" class="block text-sm font-medium text-gray-700">Tahun</label>
        <select wire:model.live="tahunFilter" id="tahunFilter"
          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
          <option value="">Semua Tahun</option>
          @foreach($availableYears as $year)
            <option value="{{ $year }}">{{ $year }}</option>
          @endforeach
        </select>
      </div>

      <div>
        <label for="gelombangFilter" class="block text-sm font-medium text-gray-700">Gelombang</label>
        <select wire:model.live="gelombangFilter" id="gelombangFilter"
          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
          <option value="">Semua Gelombang</option>
          @foreach($availableWaves as $wave)
            <option value="{{ $wave }}">Gelombang {{ $wave }}</option>
          @endforeach
        </select>
      </div>

      <div wire:loading class="flex items-center ml-2 text-green-600 text-sm font-medium">
        <svg class="animate-spin h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
          <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
          <path class="opacity-75" fill="currentColor"
            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
          </path>
        </svg>
        Memuat data...
      </div>


    </div>
  </div>

  <div class="bg-white rounded-lg shadow-lg overflow-hidden border border-gray-200">
    {{-- Tambahkan wire:loading.class untuk efek visual saat loading --}}
    <div class="overflow-x-auto relative" wire:loading.class="opacity-50 pointer-events-none">
      <table class="w-full min-w-full divide-y divide-gray-200">
        <thead class="bg-gradient-to-r from-green-600 to-green-700">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">No. Pendaftaran</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Nama Lengkap</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">NISN / NIK</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Jenjang</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Tahun / Gelombang
            </th>
            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Status Konfirmasi
            </th>
            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Pembayaran</th>
            <th class="px-4 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Tgl Daftar</th>
            <th class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">Aksi</th>
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
                    <p class="text-sm font-medium text-gray-900">{{ $row->nomor_pendaftaran }}</p>
                  </div>
                </div>
              </td>

              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm font-medium text-gray-900">{{ $row->nama_lengkap }}</div>
              </td>

              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex flex-col space-y-1">
                  <div class="text-xs text-gray-700 font-mono bg-gray-50 px-2 py-0.5 rounded inline-block">NISN:
                    {{ $row->nisn }}
                  </div>
                  <div class="text-xs text-gray-700 font-mono bg-gray-50 px-2 py-0.5 rounded inline-block">NIK:
                    {{ $row->nik_siswa }}
                  </div>
                </div>
              </td>

              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-700 font-mono 
                                                  @if($row->jenjang_daftar == 'MA') bg-blue-100 text-blue-800
                                                  @elseif($row->jenjang_daftar == 'MTS') bg-purple-100 text-purple-800
                                                  @else bg-gray-50 text-gray-700
                                                  @endif
                                                  px-3 py-1 rounded inline-block">
                  {{ $row->jenjang_daftar }}
                </div>
              </td>

              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm font-medium text-gray-900">{{ $row->reg_tahun }}</div>
                <div class="text-xs text-gray-500">Gel. {{ $row->reg_gelombang }}</div>
              </td>

              <td class="px-6 py-4 whitespace-nowrap">
                @php
                  $status = $row->reg_status ?? 'Pending';
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
                @if ($row->is_paid)
                  <span
                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                    <i class="fas fa-check-circle mr-1.5"></i> Lunas
                  </span>
                @else
                  <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                    <i class="fas fa-times-circle mr-1.5"></i> Belum Lunas
                  </span>
                @endif
              </td>

              <td class="px-4 py-4 whitespace-nowrap">
                <div class="flex items-center text-sm text-gray-700">
                  <i class="fas fa-calendar-alt text-gray-400 mr-2"></i>
                  {{ $row->created_at?->format('d M Y') }}
                  <span class="text-gray-500 ml-2">{{ $row->created_at?->format('H:i') }}</span>
                </div>
              </td>

              <td class="px-6 py-4 whitespace-nowrap text-center">
                <div class="flex items-center justify-center space-x-2">
                  <a href="{{ route('admin.registrations.status', $row->id) }}"
                    class="inline-flex items-center px-3 py-2 bg-green-600 hover:bg-green-700 text-white text-xs font-medium rounded-lg transition-all duration-200 shadow-sm hover:shadow-md">
                    <i class="fas fa-eye mr-1.5"></i> Detail
                  </a>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="9" class="px-6 py-12 text-center">
                <div class="flex flex-col items-center justify-center">
                  <i class="fas fa-inbox text-gray-300 text-5xl mb-3"></i>
                  <p class="text-gray-500 font-medium">Tidak ada data</p>
                  <p class="text-gray-400 text-sm mt-1">Belum ada siswa yang terdaftar untuk filter yang dipilih.</p>
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
</div>