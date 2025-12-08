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
        <i class="fa-solid fa-file-signature mr-3"></i>
        Pengaturan Template Surat Kelulusan
      </h2>
    </div>
    <div class="p-6">
      <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-lg">
        <div class="flex items-start">
          <i class="fa-solid fa-info-circle text-blue-600 text-xl mr-3 mt-1"></i>
          <div>
            <p class="font-semibold text-blue-800 mb-1">Informasi</p>
            <p class="text-blue-700 text-sm">Isi semua field dengan benar untuk menghasilkan surat kelulusan yang sesuai
              format.</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <form wire:submit.prevent="saveSettings" class="space-y-6">
    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200">
      <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-3">
        <h3 class="text-lg font-bold text-white flex items-center">
          <span
            class="bg-white text-blue-600 w-8 h-8 rounded-lg flex items-center justify-center mr-3 text-sm font-bold">1</span>
          Header & Identitas Surat
        </h3>
      </div>
      <div class="p-6 space-y-4">
        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
            <i class="fa-solid fa-hashtag text-blue-600 mr-2"></i>
            Nomor SK
          </label>
          <input type="text" wire:model="sk_number" placeholder="Contoh: 01/PAN-PPDB/SK/XII/2023"
            class="block w-full bg-white border-2 border-blue-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 rounded-lg shadow-sm text-gray-700 py-3 px-4 transition-all">
          @error('sk_number')
            <p class="text-red-600 text-sm mt-2 flex items-center">
              <i class="fa-solid fa-exclamation-circle mr-1"></i>{{ $message }}
            </p>
          @enderror
        </div>

        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
            <i class="fa-solid fa-calendar text-blue-600 mr-2"></i>
            Tanggal Surat (Teks)
          </label>
          <input type="text" wire:model="date" placeholder="Contoh: 13 Desember 2023"
            class="block w-full bg-white border-2 border-blue-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 rounded-lg shadow-sm text-gray-700 py-3 px-4 transition-all">
        </div>

        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
            <i class="fa-solid fa-graduation-cap text-blue-600 mr-2"></i>
            Tahun Pelajaran
          </label>
          <input type="text" wire:model="school_year" placeholder="Contoh: 2024-2025"
            class="block w-full bg-white border-2 border-blue-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 rounded-lg shadow-sm text-gray-700 py-3 px-4 transition-all">
        </div>
      </div>
    </div>

    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200">
      <div class="bg-gradient-to-r from-purple-600 to-purple-700 px-6 py-3">
        <h3 class="text-lg font-bold text-white flex items-center">
          <span
            class="bg-white text-purple-600 w-8 h-8 rounded-lg flex items-center justify-center mr-3 text-sm font-bold">2</span>
          Penandatangan & Legalitas
        </h3>
      </div>
      <div class="p-6 space-y-4">
        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
            <i class="fa-solid fa-user text-purple-600 mr-2"></i>
            Nama Penandatangan
          </label>
          <input type="text" wire:model="signer_name"
            class="block w-full bg-white border-2 border-purple-300 focus:border-purple-500 focus:ring-4 focus:ring-purple-100 rounded-lg shadow-sm text-gray-700 py-3 px-4 transition-all">
          @error('signer_name')
            <p class="text-red-600 text-sm mt-2 flex items-center">
              <i class="fa-solid fa-exclamation-circle mr-1"></i>{{ $message }}
            </p>
          @enderror
        </div>

        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
            <i class="fa-solid fa-briefcase text-purple-600 mr-2"></i>
            Jabatan
          </label>
          <input type="text" wire:model="signer_title"
            class="block w-full bg-white border-2 border-purple-300 focus:border-purple-500 focus:ring-4 focus:ring-purple-100 rounded-lg shadow-sm text-gray-700 py-3 px-4 transition-all">
        </div>

        <div class="border-2 border-purple-200 rounded-lg p-4 bg-purple-50/30">
          <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
            <i class="fa-solid fa-signature text-purple-600 mr-2"></i>
            File Tanda Tangan (PNG)
          </label>
          <input type="file" wire:model="signature_image"
            class="block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-purple-100 file:text-purple-700 hover:file:bg-purple-200 transition-all">
          <span wire:loading wire:target="signature_image" class="text-sm text-purple-600 mt-2 block">
            <i class="fa-solid fa-spinner fa-spin mr-1"></i>Uploading...
          </span>

          <div class="mt-3">
            @if ($signature_image)
              <p class="text-sm font-medium text-gray-700 mb-2">Preview Baru:</p>
              <img src="{{ $signature_image->temporaryUrl() }}"
                class="h-24 border-2 border-purple-300 rounded-lg shadow-md">
            @elseif ($existing_signature)
              <p class="text-sm font-medium text-gray-700 mb-2">File Saat Ini:</p>
              <img src="{{ Storage::url($existing_signature) }}"
                class="h-24 border-2 border-purple-300 rounded-lg shadow-md">
            @endif
          </div>
        </div>

        <div class="border-2 border-purple-200 rounded-lg p-4 bg-purple-50/30">
          <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
            <i class="fa-solid fa-stamp text-purple-600 mr-2"></i>
            File Stempel (PNG)
          </label>
          <input type="file" wire:model="stamp_image"
            class="block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-purple-100 file:text-purple-700 hover:file:bg-purple-200 transition-all">
          <span wire:loading wire:target="stamp_image" class="text-sm text-purple-600 mt-2 block">
            <i class="fa-solid fa-spinner fa-spin mr-1"></i>Uploading...
          </span>

          <div class="mt-3">
            @if ($stamp_image)
              <p class="text-sm font-medium text-gray-700 mb-2">Preview Baru:</p>
              <img src="{{ $stamp_image->temporaryUrl() }}"
                class="h-24 border-2 border-purple-300 rounded-lg shadow-md">
            @elseif ($existing_stamp)
              <p class="text-sm font-medium text-gray-700 mb-2">File Saat Ini:</p>
              <img src="{{ Storage::url($existing_stamp) }}"
                class="h-24 border-2 border-purple-300 rounded-lg shadow-md">
            @endif
          </div>
        </div>
      </div>
    </div>

    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200">
      <div class="bg-gradient-to-r from-orange-600 to-orange-700 px-6 py-3">
        <h3 class="text-lg font-bold text-white flex items-center">
          <span
            class="bg-white text-orange-600 w-8 h-8 rounded-lg flex items-center justify-center mr-3 text-sm font-bold">3</span>
          Isi Surat Keputusan (Halaman 1)
        </h3>
      </div>
      <div class="p-6 space-y-4">
        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
            <i class="fa-solid fa-list-ol text-orange-600 mr-2"></i>
            Menimbang (Pisahkan dengan Enter)
          </label>
          <textarea wire:model="content_menimbang" rows="5"
            class="block w-full bg-white border-2 border-orange-300 focus:border-orange-500 focus:ring-4 focus:ring-orange-100 rounded-lg shadow-sm text-gray-700 py-3 px-4 transition-all"></textarea>
        </div>

        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
            <i class="fa-solid fa-eye text-orange-600 mr-2"></i>
            Memperhatikan (Pisahkan dengan Enter)
          </label>
          <textarea wire:model="content_memperhatikan" rows="5"
            class="block w-full bg-white border-2 border-orange-300 focus:border-orange-500 focus:ring-4 focus:ring-orange-100 rounded-lg shadow-sm text-gray-700 py-3 px-4 transition-all"></textarea>
        </div>
      </div>
    </div>

    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200">
      <div class="bg-gradient-to-r from-teal-600 to-teal-700 px-6 py-3">
        <h3 class="text-lg font-bold text-white flex items-center">
          <span
            class="bg-white text-teal-600 w-8 h-8 rounded-lg flex items-center justify-center mr-3 text-sm font-bold">4</span>
          Konten Halaman 2 (Pemberitahuan)
        </h3>
      </div>
      <div class="p-6">
        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-lg mb-4">
          <p class="text-sm text-yellow-800 flex items-center">
            <i class="fa-solid fa-lightbulb mr-2"></i>
            <strong>Tips:</strong> Gunakan <code class="bg-yellow-200 px-2 py-1 rounded">[TAHUN]</code> dalam teks agar
            otomatis diganti dengan Tahun Pelajaran.
          </p>
        </div>

        <div class="space-y-4">
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
              <i class="fa-solid fa-paragraph text-teal-600 mr-2"></i>
              Paragraf Pembuka
            </label>
            <textarea wire:model="p2_opening" rows="2"
              class="block w-full bg-white border-2 border-teal-300 focus:border-teal-500 focus:ring-4 focus:ring-teal-100 rounded-lg shadow-sm text-gray-700 py-3 px-4 transition-all"></textarea>
          </div>

          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
              <i class="fa-solid fa-check-double text-teal-600 mr-2"></i>
              Paragraf Kondisi (Diterima apabila...)
            </label>
            <textarea wire:model="p2_conditional" rows="2"
              class="block w-full bg-white border-2 border-teal-300 focus:border-teal-500 focus:ring-4 focus:ring-teal-100 rounded-lg shadow-sm text-gray-700 py-3 px-4 transition-all"></textarea>
          </div>

          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
              <i class="fa-solid fa-list-check text-teal-600 mr-2"></i>
              List Poin 1 - Kelengkapan Data (Pisahkan dengan Enter)
            </label>
            <textarea wire:model="p2_requirements" rows="3"
              class="block w-full bg-white border-2 border-teal-300 focus:border-teal-500 focus:ring-4 focus:ring-teal-100 rounded-lg shadow-sm text-gray-700 py-3 px-4 transition-all"></textarea>
          </div>

          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
              <i class="fa-solid fa-money-bill-wave text-teal-600 mr-2"></i>
              List Poin 2 - Ketentuan Pembayaran (Pisahkan dengan Enter)
            </label>
            <textarea wire:model="p2_payment_terms" rows="5"
              class="block w-full bg-white border-2 border-teal-300 focus:border-teal-500 focus:ring-4 focus:ring-teal-100 rounded-lg shadow-sm text-gray-700 py-3 px-4 transition-all"></textarea>
          </div>

          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
              <i class="fa-solid fa-door-open text-teal-600 mr-2"></i>
              Intro Pengunduran Diri
            </label>
            <input type="text" wire:model="p2_resign_intro"
              class="block w-full bg-white border-2 border-teal-300 focus:border-teal-500 focus:ring-4 focus:ring-teal-100 rounded-lg shadow-sm text-gray-700 py-3 px-4 transition-all">
          </div>

          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
              <i class="fa-solid fa-clipboard-list text-teal-600 mr-2"></i>
              List Poin Pengunduran Diri (Pisahkan dengan Enter)
            </label>
            <textarea wire:model="p2_resign_points" rows="6"
              class="block w-full bg-white border-2 border-teal-300 focus:border-teal-500 focus:ring-4 focus:ring-teal-100 rounded-lg shadow-sm text-gray-700 py-3 px-4 transition-all"></textarea>
          </div>

          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
              <i class="fa-solid fa-flag-checkered text-teal-600 mr-2"></i>
              Paragraf Penutup
            </label>
            <textarea wire:model="p2_closing" rows="2"
              class="block w-full bg-white border-2 border-teal-300 focus:border-teal-500 focus:ring-4 focus:ring-teal-100 rounded-lg shadow-sm text-gray-700 py-3 px-4 transition-all"></textarea>
          </div>

          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
              <i class="fa-solid fa-building-columns text-teal-600 mr-2"></i>
              Footer / NB (Info Rekening)
            </label>
            <textarea wire:model="p2_footer_note" rows="3"
              class="block w-full bg-white border-2 border-teal-300 focus:border-teal-500 focus:ring-4 focus:ring-teal-100 rounded-lg shadow-sm text-gray-700 py-3 px-4 transition-all"></textarea>
          </div>
        </div>
      </div>
    </div>

    <div class="flex justify-end pb-6">
      <button type="submit"
        class="bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-bold px-12 py-4 rounded-lg shadow-lg transition-all duration-300 transform hover:-translate-y-1 hover:shadow-xl flex items-center text-lg">
        <span wire:loading.remove wire:target="saveSettings" class="flex items-center">
          <i class="fa-solid fa-save mr-3 text-xl"></i>
          Simpan Semua Perubahan
        </span>
        <span wire:loading wire:target="saveSettings" class="flex items-center">
          <i class="fa-solid fa-spinner fa-spin mr-3 text-xl"></i>
          Menyimpan...
        </span>
      </button>
    </div>
  </form>
</div>
