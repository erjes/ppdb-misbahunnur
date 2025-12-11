<div class="space-y-6">
  @if (session()->has('message'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-sm" role="alert">
      <div class="flex items-center">
        <i class="fa-solid fa-check-circle text-2xl mr-3"></i>
        <p class="font-medium">{{ session('message') }}</p>
      </div>
    </div>
  @endif

  <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200">
    <div class="bg-gradient-to-r from-green-600 to-green-700 px-6 py-4">
      <h2 class="text-xl font-bold text-white flex items-center">
        <i class="fa-solid fa-money-check-dollar mr-3"></i>
        Verifikasi Pembayaran
      </h2>
    </div>
  </div>

  <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200">
    <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-3">
      <h3 class="text-lg font-bold text-white flex items-center">
        <i class="fa-solid fa-info-circle mr-2"></i>
        Informasi Pembayaran
      </h3>
    </div>
    <div class="p-6">
      <div class="grid md:grid-cols-2 gap-6">
        <div class="flex items-start space-x-3">
          <div class="bg-blue-100 p-3 rounded-lg">
            <i class="fa-solid fa-id-card text-blue-600 text-xl"></i>
          </div>
          <div>
            <p class="text-sm text-gray-600 mb-1">Nomor Pendaftaran</p>
            <p class="font-semibold text-gray-800 text-lg">{{ $payment->student->nomor_pendaftaran }}</p>
          </div>
        </div>

        <div class="flex items-start space-x-3">
          <div class="bg-blue-100 p-3 rounded-lg">
            <i class="fa-solid fa-user text-blue-600 text-xl"></i>
          </div>
          <div>
            <p class="text-sm text-gray-600 mb-1">Nama Lengkap</p>
            <p class="font-semibold text-gray-800 text-lg">{{ $payment->student->nama_lengkap }}</p>
          </div>
        </div>

        <div class="flex items-start space-x-3">
          <div class="bg-green-100 p-3 rounded-lg">
            <i class="fa-solid fa-money-bill-wave text-green-600 text-xl"></i>
          </div>
          <div>
            <p class="text-sm text-gray-600 mb-1">Jumlah Pembayaran</p>
            <p class="font-bold text-green-700 text-xl">Rp {{ number_format($payment->jumlah, 0, ',', '.') }}</p>
          </div>
        </div>

        <div class="flex items-start space-x-3">
          <div class="bg-purple-100 p-3 rounded-lg">
            <i class="fa-solid fa-calendar-days text-purple-600 text-xl"></i>
          </div>
          <div>
            <p class="text-sm text-gray-600 mb-1">Tanggal Pembayaran</p>
            <p class="font-semibold text-gray-800">{{ \Carbon\Carbon::parse($payment->tanggal_bayar)->format('d F Y') }}
            </p>
          </div>
        </div>
      </div>

      <div class="mt-6 pt-6 border-t border-gray-200">
        <div class="flex items-center space-x-3">
          <p class="text-sm text-gray-600 font-medium">Status Verifikasi:</p>
          @if ($payment->verifikasi == 0)
            <span
              class="bg-yellow-100 text-yellow-800 px-4 py-2 rounded-full text-sm font-semibold inline-flex items-center">
              <i class="fa-solid fa-clock mr-2"></i>
              Menunggu Verifikasi
            </span>
          @else
            <span
              class="bg-green-100 text-green-800 px-4 py-2 rounded-full text-sm font-semibold inline-flex items-center">
              <i class="fa-solid fa-check-circle mr-2"></i>
              Terverifikasi (Lunas)
            </span>
          @endif
        </div>
      </div>
    </div>
  </div>

  <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200">
    <div class="bg-gradient-to-r from-purple-600 to-purple-700 px-6 py-3">
      <h3 class="text-lg font-bold text-white flex items-center">
        <i class="fa-solid fa-receipt mr-2"></i>
        Bukti Pembayaran
      </h3>
    </div>
    <div class="p-6">
      @php
        $paymentUrl = route('admin.payments.show', [
          'studentId' => $payment->student_id,
          'filename' => basename($payment->bukti_pembayaran),
        ]);
      @endphp

      <div class="relative group inline-block">
        <a href="{{ $paymentUrl }}" target="_blank" class="block">
          <img src="{{ $paymentUrl }}" alt="Bukti Pembayaran"
            class="max-w-md w-full rounded-lg shadow-lg border-2 border-purple-200 transition-all duration-300 group-hover:border-purple-400 group-hover:shadow-xl">

          <div
            class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all duration-300 flex items-center justify-center rounded-lg">
            <div class="transform scale-0 group-hover:scale-100 transition-transform duration-300">
              <div class="bg-white text-purple-600 px-6 py-3 rounded-lg font-semibold shadow-xl flex items-center">
                <i class="fa-solid fa-expand mr-2"></i>
                Lihat Ukuran Penuh
              </div>
            </div>
          </div>
        </a>
      </div>

      <div class="mt-4">
        <a href="{{ $paymentUrl }}" target="_blank"
          class="inline-flex items-center bg-purple-600 hover:bg-purple-700 text-white font-medium px-4 py-2 rounded-lg shadow transition-all duration-300 transform hover:-translate-y-0.5">
          <i class="fa-solid fa-external-link-alt mr-2"></i>
          Buka di Tab Baru
        </a>
      </div>
    </div>
  </div>

  <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200">
    <div class="bg-gradient-to-r from-orange-600 to-orange-700 px-6 py-3">
      <h3 class="text-lg font-bold text-white flex items-center">
        <i class="fa-solid fa-pen-to-square mr-2"></i>
        Update Status Verifikasi
      </h3>
    </div>
    <div class="p-6">
      <div class="space-y-4">
        <div>
          <label for="verifikasi" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
            <i class="fa-solid fa-toggle-on text-orange-600 mr-2"></i>
            Status Verifikasi
          </label>
          <select wire:model="verifikasi" id="verifikasi"
            class="block w-full bg-white border-2 border-orange-300 focus:border-orange-500 focus:ring-4 focus:ring-orange-100 rounded-lg shadow-sm text-gray-700 py-3 px-4 transition-all">
            <option value="0">⏳ Menunggu Verifikasi</option>
            <option value="1">✓ Terverifikasi (Lunas)</option>
          </select>
        </div>

        <div class="bg-orange-50 border-l-4 border-orange-400 p-4 rounded-lg">
          <div class="flex items-start">
            <i class="fa-solid fa-exclamation-triangle text-orange-600 text-xl mr-3 mt-1"></i>
            <div>
              <p class="font-semibold text-orange-800 mb-1">Perhatian</p>
              <p class="text-sm text-orange-700">Pastikan bukti pembayaran sudah valid sebelum memverifikasi. Status
                yang sudah diubah akan mempengaruhi proses pendaftaran siswa.</p>
            </div>
          </div>
        </div>

        <div class="flex justify-end pt-2">

          {{-- TOMBOL UPDATE DENGAN LOADING STATE --}}
          <button wire:click="updatePaymentStatus" wire:loading.attr="disabled" wire:target="updatePaymentStatus"
            class="bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-bold px-8 py-3 rounded-lg shadow-lg transition-all duration-300 transform hover:-translate-y-1 hover:shadow-xl flex items-center disabled:opacity-50 disabled:cursor-not-allowed">

            {{-- Tampilan Normal --}}
            <span wire:loading.remove wire:target="updatePaymentStatus" class="flex items-center">
              <i class="fa-solid fa-save mr-2"></i>
              Update Status Pembayaran
            </span>

            {{-- Tampilan Loading --}}
            <span wire:loading wire:target="updatePaymentStatus" class="flex items-center">
              <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor"
                  d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                </path>
              </svg>
              Sedang Memproses...
            </span>
          </button>

        </div>
      </div>
    </div>
  </div>

  <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border-l-4 border-blue-500 p-5 rounded-lg shadow-sm">
    <div class="flex items-start">
      <i class="fa-solid fa-lightbulb text-blue-600 text-xl mr-3 mt-1"></i>
      <div>
        <p class="font-semibold text-blue-800 mb-2">Tips Verifikasi</p>
        <ul class="text-sm text-blue-700 space-y-1 list-disc list-inside">
          <li>Pastikan nominal pembayaran sesuai dengan yang tertera di bukti</li>
          <li>Periksa tanggal pembayaran untuk memastikan masih dalam periode yang valid</li>
          <li>Verifikasi nama pengirim sesuai dengan data siswa atau orang tua</li>
          <li>Jika ada ketidaksesuaian, hubungi siswa/orang tua untuk klarifikasi</li>
        </ul>
      </div>
    </div>
  </div>
</div>