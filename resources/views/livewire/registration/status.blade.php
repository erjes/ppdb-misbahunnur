<div class="space-y-6 overflow-auto">
  @if (session()->has('message'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-sm" role="alert">
      <div class="flex items-center">
        <i class="fa-solid fa-check-circle text-2xl mr-3"></i>
        <p class="font-medium">{{ session('message') }}</p>
      </div>
    </div>
  @endif

  @if ($registration)
    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200">
      <div class="bg-gradient-to-r from-green-600 to-green-700 px-6 py-4">
        <h2 class="text-xl font-bold text-white flex items-center">
          <i class="fa-solid fa-clipboard-check mr-3"></i>
          Status Pendaftaran Anda
        </h2>
      </div>

      <div class="p-6">
        <div class="flex items-center justify-between mb-6">
          <div>
            <p class="text-sm text-gray-600 mb-1">Status Saat Ini</p>
            <div class="flex items-center space-x-2">
              @php
                $statusConfig = [
                  'pending' => [
                    'bg' => 'bg-yellow-100',
                    'text' => 'text-yellow-800',
                    'icon' => 'fa-clock',
                    'label' => 'Menunggu Verifikasi',
                  ],
                  'approved' => [
                    'bg' => 'bg-green-100',
                    'text' => 'text-green-800',
                    'icon' => 'fa-check-circle',
                    'label' => 'Disetujui',
                  ],
                  'rejected' => [
                    'bg' => 'bg-red-100',
                    'text' => 'text-red-800',
                    'icon' => 'fa-times-circle',
                    'label' => 'Ditolak',
                  ],
                ];
                $status = $statusConfig[$registration->status] ?? $statusConfig['pending'];
              @endphp
              <span
                class="{{ $status['bg'] }} {{ $status['text'] }} px-4 py-2 rounded-full text-sm font-semibold flex items-center">
                <i class="fa-solid {{ $status['icon'] }} mr-2"></i>
                {{ $status['label'] }}
              </span>
            </div>
          </div>

          @if ($registration->status == 'approved')
            <button wire:click="exportApprovedRegistration"
              class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-3 rounded-lg shadow-md transition-all duration-300 transform hover:-translate-y-1 flex items-center">
              <i class="fa-solid fa-file-pdf mr-2"></i>
              Cetak Surat
            </button>
          @endif
        </div>

        @if ($registration->is_paid != 1)
          <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-lg mb-6">
            <div class="flex items-center justify-between">
              <div class="flex items-center">
                <i class="fa-solid fa-exclamation-triangle text-yellow-600 text-2xl mr-3"></i>
                <div>
                  <p class="font-semibold text-yellow-800">Pembayaran Belum Dilakukan</p>
                  <p class="text-sm text-yellow-700">Silakan lakukan pembayaran untuk melanjutkan proses pendaftaran</p>
                </div>
              </div>
              <a href="{{ route('registration.payment.upload', ['studentId' => $student->id]) }}" target="_blank"
                class="bg-yellow-600 hover:bg-yellow-700 text-white font-semibold px-6 py-2 rounded-lg shadow transition-all duration-300 flex items-center">
                <i class="fa-solid fa-credit-card mr-2"></i>
                Bayar Sekarang
              </a>
            </div>
          </div>
        @endif
      </div>
    </div>

    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200">
      <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-3">
        <h3 class="text-lg font-bold text-white flex items-center">
          <i class="fa-solid fa-user mr-2"></i>
          Data Calon Santri
        </h3>
      </div>
      <div class="p-6 grid md:grid-cols-2 gap-4">
        <div class="flex items-start space-x-3">
          <i class="fa-solid fa-id-card text-blue-600 mt-1"></i>
          <div>
            <p class="text-sm text-gray-600">Nomor Pendaftaran</p>
            <p class="font-semibold text-gray-800">{{ $student->nomor_pendaftaran }}</p>
          </div>
        </div>
        <div class="flex items-start space-x-3">
          <i class="fa-solid fa-user text-blue-600 mt-1"></i>
          <div>
            <p class="text-sm text-gray-600">Nama Lengkap</p>
            <p class="font-semibold text-gray-800">{{ $student->nama_lengkap }}</p>
          </div>
        </div>
        <div class="flex items-start space-x-3">
          <i class="fa-solid fa-map-marker-alt text-blue-600 mt-1"></i>
          <div>
            <p class="text-sm text-gray-600">Tempat Lahir</p>
            <p class="font-semibold text-gray-800">{{ $student->tempat_kelahiran }}</p>
          </div>
        </div>
        <div class="flex items-start space-x-3">
          <i class="fa-solid fa-calendar text-blue-600 mt-1"></i>
          <div>
            <p class="text-sm text-gray-600">Tanggal Lahir</p>
            <p class="font-semibold text-gray-800">{{ \Carbon\Carbon::parse($student->tanggal_lahir)->format('d-m-Y') }}
            </p>
          </div>
        </div>
        <div class="flex items-start space-x-3">
          <i class="fa-solid fa-venus-mars text-blue-600 mt-1"></i>
          <div>
            <p class="text-sm text-gray-600">Jenis Kelamin</p>
            <p class="font-semibold text-gray-800">{{ $student->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
          </div>
        </div>
        <div class="flex items-start space-x-3">
          <i class="fa-solid fa-praying-hands text-blue-600 mt-1"></i>
          <div>
            <p class="text-sm text-gray-600">Agama</p>
            <p class="font-semibold text-gray-800">{{ $student->agama }}</p>
          </div>
        </div>
      </div>
    </div>

    <div class="grid md:grid-cols-2 gap-6">
      <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200">
        <div class="bg-gradient-to-r from-purple-600 to-purple-700 px-6 py-3">
          <h3 class="text-lg font-bold text-white flex items-center">
            <i class="fa-solid fa-home mr-2"></i>
            Data Alamat
          </h3>
        </div>
        <div class="p-6 space-y-4">
          <div class="flex items-start space-x-3">
            <i class="fa-solid fa-map text-purple-600 mt-1"></i>
            <div>
              <p class="text-sm text-gray-600">Alamat Lengkap</p>
              <p class="font-semibold text-gray-800">{{ $addressData['alamat_lengkap'] ?? 'Tidak tersedia' }}</p>
            </div>
          </div>
          <div class="flex items-start space-x-3">
            <i class="fa-solid fa-map-pin text-purple-600 mt-1"></i>
            <div>
              <p class="text-sm text-gray-600">Provinsi</p>
              <p class="font-semibold text-gray-800">{{ $addressData['provinsi'] ?? 'Tidak tersedia' }}</p>
            </div>
          </div>
        </div>
      </div>

      <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200">
        <div class="bg-gradient-to-r from-orange-600 to-orange-700 px-6 py-3">
          <h3 class="text-lg font-bold text-white flex items-center">
            <i class="fa-solid fa-users mr-2"></i>
            Data Orang Tua
          </h3>
        </div>
        <div class="p-6 space-y-4">
          <div class="flex items-start space-x-3">
            <i class="fa-solid fa-male text-orange-600 mt-1"></i>
            <div>
              <p class="text-sm text-gray-600">Nama Ayah</p>
              <p class="font-semibold text-gray-800">{{ $parentData['nama_ayah'] ?? 'Tidak tersedia' }}</p>
            </div>
          </div>
          <div class="flex items-start space-x-3">
            <i class="fa-solid fa-female text-orange-600 mt-1"></i>
            <div>
              <p class="text-sm text-gray-600">Nama Ibu</p>
              <p class="font-semibold text-gray-800">{{ $parentData['nama_ibu'] ?? 'Tidak tersedia' }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200">
      <div class="bg-gradient-to-r from-teal-600 to-teal-700 px-6 py-3">
        <h3 class="text-lg font-bold text-white flex items-center">
          <i class="fa-solid fa-school mr-2"></i>
          Data Sekolah Asal
        </h3>
      </div>
      <div class="p-6 grid md:grid-cols-3 gap-4">
        <div class="flex items-start space-x-3">
          <i class="fa-solid fa-building text-teal-600 mt-1"></i>
          <div>
            <p class="text-sm text-gray-600">Nama Sekolah</p>
            <p class="font-semibold text-gray-800">{{ $schoolData['nama'] ?? 'Tidak tersedia' }}</p>
          </div>
        </div>
        <div class="flex items-start space-x-3">
          <i class="fa-solid fa-hashtag text-teal-600 mt-1"></i>
          <div>
            <p class="text-sm text-gray-600">NPSN</p>
            <p class="font-semibold text-gray-800">{{ $schoolData['npsn'] ?? 'Tidak tersedia' }}</p>
          </div>
        </div>
        <div class="flex items-start space-x-3">
          <i class="fa-solid fa-graduation-cap text-teal-600 mt-1"></i>
          <div>
            <p class="text-sm text-gray-600">Jenjang</p>
            <p class="font-semibold text-gray-800">{{ $schoolData['jenjang'] ?? 'Tidak tersedia' }}</p>
          </div>
        </div>
      </div>
    </div>

    @if ($registration->status == 'rejected')
      <div class="bg-red-50 border-l-4 border-red-500 p-6 rounded-lg">
        <div class="flex items-start">
          <i class="fa-solid fa-info-circle text-red-600 text-2xl mr-3 mt-1"></i>
          <div>
            <h4 class="font-semibold text-red-800 mb-2">Catatan Penolakan</h4>
            <p class="text-red-700">{{ $registration->catatan ?? 'Tidak ada catatan' }}</p>
          </div>
        </div>
      </div>
    @endif
  @else
    <div class="bg-white rounded-xl shadow-md p-12 text-center">
      <i class="fa-solid fa-inbox text-gray-400 text-6xl mb-4"></i>
      <h3 class="text-2xl font-bold text-gray-800 mb-2">Data Pendaftaran Tidak Ditemukan</h3>
      <p class="text-gray-600 mb-6">Anda belum melakukan pendaftaran atau data tidak tersedia</p>
      <a href="{{ route('registration.form', ['slug' => 'ppdb-online']) }}"
        class="bg-green-600 hover:bg-green-700 text-white font-semibold px-8 py-3 rounded-lg shadow-md transition-all duration-300 inline-flex items-center">
        <i class="fa-solid fa-plus-circle mr-2"></i>
        Mulai Pendaftaran
      </a>
    </div>
  @endif
</div>