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
        <i class="fa-solid fa-file-upload mr-3"></i>
        Form Upload Dokumen Persyaratan
      </h2>
    </div>
    <div class="p-6">
      <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-lg">
        <div class="flex items-start">
          <i class="fa-solid fa-info-circle text-blue-600 text-xl mr-3 mt-1"></i>
          <div>
            <p class="font-semibold text-blue-800 mb-1">Jalur Pendaftaran</p>
            <p class="text-blue-700 text-lg font-bold">{{ $jalurDaftar }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <form wire:submit.prevent="saveDocuments" enctype="multipart/form-data" class="space-y-6">
    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200">
      <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-3">
        <h3 class="text-lg font-bold text-white flex items-center">
          <i class="fa-solid fa-file-alt mr-2"></i>
          Dokumen Wajib
        </h3>
      </div>
      <div class="p-6 space-y-4">
        <div class="border border-gray-200 rounded-lg p-4 hover:border-green-500 transition-all duration-300">
          <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
            <span
              class="bg-green-600 text-white w-6 h-6 rounded-full flex items-center justify-center text-xs mr-2">1</span>
            Akta Kelahiran
          </label>
          <input type="file" wire:model="akta_kelahiran"
            class="block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100 transition-all duration-300">
          @error('akta_kelahiran')
            <p class="text-red-600 text-sm mt-2 flex items-center">
              <i class="fa-solid fa-exclamation-circle mr-1"></i>
              {{ $message }}
            </p>
          @enderror
        </div>

        <div class="border border-gray-200 rounded-lg p-4 hover:border-green-500 transition-all duration-300">
          <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
            <span
              class="bg-green-600 text-white w-6 h-6 rounded-full flex items-center justify-center text-xs mr-2">2</span>
            Kartu Keluarga
          </label>
          <input type="file" wire:model="kartu_keluarga"
            class="block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100 transition-all duration-300">
          @error('kartu_keluarga')
            <p class="text-red-600 text-sm mt-2 flex items-center">
              <i class="fa-solid fa-exclamation-circle mr-1"></i>
              {{ $message }}
            </p>
          @enderror
        </div>

        <div class="border border-gray-200 rounded-lg p-4 hover:border-green-500 transition-all duration-300">
          <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
            <span
              class="bg-green-600 text-white w-6 h-6 rounded-full flex items-center justify-center text-xs mr-2">3</span>
            KTP Orang Tua/Calon Santri
          </label>
          <input type="file" wire:model="ktp_ortu"
            class="block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100 transition-all duration-300">
          @error('ktp_ortu')
            <p class="text-red-600 text-sm mt-2 flex items-center">
              <i class="fa-solid fa-exclamation-circle mr-1"></i>
              {{ $message }}
            </p>
          @enderror
        </div>

        <div class="border border-gray-200 rounded-lg p-4 hover:border-green-500 transition-all duration-300">
          <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
            <span
              class="bg-green-600 text-white w-6 h-6 rounded-full flex items-center justify-center text-xs mr-2">4</span>
            Pas Foto Berwarna 3x4
          </label>
          <input type="file" wire:model="pas_foto"
            class="block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100 transition-all duration-300">
          @error('pas_foto')
            <p class="text-red-600 text-sm mt-2 flex items-center">
              <i class="fa-solid fa-exclamation-circle mr-1"></i>
              {{ $message }}
            </p>
          @enderror
        </div>

        <div class="border border-gray-200 rounded-lg p-4 hover:border-green-500 transition-all duration-300">
          <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
            <span
              class="bg-green-600 text-white w-6 h-6 rounded-full flex items-center justify-center text-xs mr-2">5</span>
            Ijazah / Surat Keterangan Lulus
          </label>
          <input type="file" wire:model="ijazah_skl"
            class="block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100 transition-all duration-300">
          @error('ijazah_skl')
            <p class="text-red-600 text-sm mt-2 flex items-center">
              <i class="fa-solid fa-exclamation-circle mr-1"></i>
              {{ $message }}
            </p>
          @enderror
        </div>

        <div class="border border-gray-200 rounded-lg p-4 hover:border-green-500 transition-all duration-300">
          <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
            <span
              class="bg-green-600 text-white w-6 h-6 rounded-full flex items-center justify-center text-xs mr-2">6</span>
            Kartu NISN & SKHUN
          </label>
          <input type="file" wire:model="kartu_nisn"
            class="block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100 transition-all duration-300">
          @error('kartu_nisn')
            <p class="text-red-600 text-sm mt-2 flex items-center">
              <i class="fa-solid fa-exclamation-circle mr-1"></i>
              {{ $message }}
            </p>
          @enderror
        </div>

        <div class="border border-gray-200 rounded-lg p-4 hover:border-green-500 transition-all duration-300">
          <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
            <span
              class="bg-green-600 text-white w-6 h-6 rounded-full flex items-center justify-center text-xs mr-2">7</span>
            Rapor Kelas 4, 5, 6 Semester Ganjil/Genap
          </label>
          <input type="file" wire:model="rapor"
            class="block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100 transition-all duration-300">
          @error('rapor')
            <p class="text-red-600 text-sm mt-2 flex items-center">
              <i class="fa-solid fa-exclamation-circle mr-1"></i>
              {{ $message }}
            </p>
          @enderror
        </div>

        <div class="border border-gray-200 rounded-lg p-4 hover:border-green-500 transition-all duration-300">
          <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
            <span
              class="bg-green-600 text-white w-6 h-6 rounded-full flex items-center justify-center text-xs mr-2">8</span>
            Surat Keterangan Aktif Sekolah/Madrasah Asal
          </label>
          <input type="file" wire:model="surat_aktif_sekolah"
            class="block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100 transition-all duration-300">
          @error('surat_aktif_sekolah')
            <p class="text-red-600 text-sm mt-2 flex items-center">
              <i class="fa-solid fa-exclamation-circle mr-1"></i>
              {{ $message }}
            </p>
          @enderror
        </div>
      </div>
    </div>

    @if ($jalurDaftar == 'Yatim' || $jalurDaftar == 'Dhuafa' || $jalurDaftar == 'Beasiswa')
      <div class="bg-white rounded-xl shadow-md overflow-hidden border border-orange-200">
        <div class="bg-gradient-to-r from-orange-600 to-orange-700 px-6 py-3">
          <h3 class="text-lg font-bold text-white flex items-center">
            <i class="fa-solid fa-star mr-2"></i>
            Persyaratan Tambahan Jalur {{ $jalurDaftar }}
          </h3>
        </div>
        <div class="p-6 space-y-4">
          @if ($jalurDaftar == 'Yatim')
            <div wire:key="dok-yatim" class="space-y-4">
              <div
                class="border border-orange-200 rounded-lg p-4 hover:border-orange-500 transition-all duration-300 bg-orange-50">
                <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                  <i class="fa-solid fa-file-medical text-orange-600 mr-2"></i>
                  Surat Kematian Orang Tua/Bapak (Wajib)
                </label>
                <input type="file" wire:model="surat_kematian_ortu"
                  class="block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-orange-100 file:text-orange-700 hover:file:bg-orange-200 transition-all duration-300">
                @error('surat_kematian_ortu')
                  <p class="text-red-600 text-sm mt-2 flex items-center">
                    <i class="fa-solid fa-exclamation-circle mr-1"></i>
                    {{ $message }}
                  </p>
                @enderror
              </div>

              <div
                class="border border-orange-200 rounded-lg p-4 hover:border-orange-500 transition-all duration-300 bg-orange-50">
                <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                  <i class="fa-solid fa-file-contract text-orange-600 mr-2"></i>
                  Surat Keterangan Tidak Mampu (SKTM) dari Kelurahan (Wajib)
                </label>
                <input type="file" wire:model="surat_keterangan_tdk_mampu"
                  class="block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-orange-100 file:text-orange-700 hover:file:bg-orange-200 transition-all duration-300">
                @error('surat_keterangan_tdk_mampu')
                  <p class="text-red-600 text-sm mt-2 flex items-center">
                    <i class="fa-solid fa-exclamation-circle mr-1"></i>
                    {{ $message }}
                  </p>
                @enderror
              </div>
            </div>
          @endif

          @if ($jalurDaftar == 'Dhuafa' || $jalurDaftar == 'Beasiswa')
            <div wire:key="dok-prestasi-dhuafa" class="space-y-4">
              @if ($jalurDaftar == 'Dhuafa')
                <div
                  class="border border-orange-200 rounded-lg p-4 hover:border-orange-500 transition-all duration-300 bg-orange-50">
                  <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                    <i class="fa-solid fa-file-contract text-orange-600 mr-2"></i>
                    Surat Keterangan Tidak Mampu (SKTM) dari Kelurahan (Wajib)
                  </label>
                  <input type="file" wire:model="surat_keterangan_tdk_mampu"
                    class="block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-orange-100 file:text-orange-700 hover:file:bg-orange-200 transition-all duration-300">
                  @error('surat_keterangan_tdk_mampu')
                    <p class="text-red-600 text-sm mt-2 flex items-center">
                      <i class="fa-solid fa-exclamation-circle mr-1"></i>
                      {{ $message }}
                    </p>
                  @enderror
                </div>
              @endif

              <div
                class="border border-orange-200 rounded-lg p-4 hover:border-orange-500 transition-all duration-300 bg-orange-50">
                <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                  <i class="fa-solid fa-certificate text-orange-600 mr-2"></i>
                  Sertifikat Kompetisi/Lomba, Hafalan 5 Juz, atau Transkrip Ranking 1/2 (Wajib)
                </label>
                <input type="file" wire:model="sertifikat_tambahan"
                  class="block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-orange-100 file:text-orange-700 hover:file:bg-orange-200 transition-all duration-300">
                @error('sertifikat_tambahan')
                  <p class="text-red-600 text-sm mt-2 flex items-center">
                    <i class="fa-solid fa-exclamation-circle mr-1"></i>
                    {{ $message }}
                  </p>
                @enderror
              </div>
            </div>
          @endif
        </div>
      </div>
    @endif

    <div class="flex justify-end">
      <button type="submit"
        class="bg-green-600 hover:bg-green-700 text-white font-bold px-12 py-4 rounded-lg shadow-lg transition-all duration-300 transform hover:-translate-y-1 hover:shadow-xl flex items-center text-lg">
        <i class="fa-solid fa-cloud-upload-alt mr-3 text-xl"></i>
        Simpan dan Unggah Semua Dokumen
      </button>
    </div>
  </form>
</div>
