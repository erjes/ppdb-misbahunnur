<div class="space-y-6">
  {{-- ALERT SUKSES --}}
  @if (session()->has('message'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-sm animate-fade-in-down"
      role="alert">
      <div class="flex items-center">
        <i class="fa-solid fa-check-circle text-2xl mr-3"></i>
        <p class="font-medium">{{ session('message') }}</p>
      </div>
    </div>
  @endif

  {{-- HEADER HEADER --}}
  <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200">
    <div class="bg-gradient-to-r from-green-600 to-green-700 px-6 py-4">
      <h2 class="text-xl font-bold text-white flex items-center">
        <i class="fa-solid fa-file-upload mr-3"></i>
        Upload Dokumen Persyaratan
      </h2>
    </div>
    <div class="p-6">
      <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-lg">
        <div class="flex items-start mb-4">
          <i class="fa-solid fa-info-circle text-blue-600 text-xl mr-3 mt-1"></i>
          <div>
            <p class="font-semibold text-blue-800 mb-1">Jalur Pendaftaran Anda:</p>
            <p class="text-blue-700 text-2xl font-bold uppercase tracking-wide">{{ $jalurDaftar }}</p>
          </div>
        </div>

        <div class="ml-8 border-t border-blue-200 pt-4 mt-2">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-blue-900">

            <div>
              <p class="font-bold mb-1 flex items-center">
                Informasi Singkat
              </p>
              <p class="leading-relaxed opacity-90">
                Pastikan Anda mengunggah hasil scan atau foto dokumen asli yang <strong>jelas, terbaca, dan tidak
                  terpotong</strong>. Dokumen ini akan diverifikasi oleh panitia PPDB sebagai syarat kelulusan
                administrasi.
              </p>
            </div>

            <div>
              <p class="font-bold mb-1 flex items-center">
                <i class="fa-solid fa-triangle-exclamation mr-2 text-blue-600"></i> Persyaratan Dokumen
              </p>
              <ul class="list-disc list-inside space-y-1 opacity-90">
                <li>Format file: <span class="font-semibold bg-blue-100 px-1 rounded">PDF, JPG, JPEG, PNG</span></li>
                <li>Ukuran maksimal: <span class="font-semibold bg-blue-100 px-1 rounded">2 MB / file</span></li>
                <li>Pastikan orientasi dokumen benar (tegak/landscape)</li>
              </ul>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>

  <form wire:submit.prevent="saveDocuments" enctype="multipart/form-data" class="space-y-6">

    {{-- BAGIAN 1: DOKUMEN UMUM --}}
    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200">
      <div class="bg-gray-50 px-6 py-3 border-b border-gray-200">
        <h3 class="text-lg font-bold text-gray-700 flex items-center">
          <i class="fa-solid fa-folder-open mr-2 text-green-600"></i>
          Dokumen Umum
        </h3>
      </div>

      <div class="p-6 space-y-6">
        {{-- HELPER UNTUK MEMBUAT INPUT FILE AGAR TIDAK DUPLIKASI KODE --}}
        {{-- 1. AKTA KELAHIRAN --}}
        <div
          class="border border-gray-200 rounded-lg p-4 hover:border-green-400 transition-all {{ isset($existingDocuments['Akta Kelahiran']) ? 'bg-green-50 border-green-200' : 'bg-white' }}">
          <div class="flex justify-between items-center mb-2">
            <label class="font-semibold text-gray-700">1. Akta Kelahiran</label>
            @if(isset($existingDocuments['Akta Kelahiran']))
              <span class="px-3 py-1 bg-green-200 text-green-800 text-xs font-bold rounded-full flex items-center">
                <i class="fa-solid fa-check mr-1"></i> Sudah Diupload
              </span>
            @endif
          </div>
          <input type="file" wire:model="akta_kelahiran"
            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-100 file:text-green-700 hover:file:bg-green-200 transition-all">
          <div wire:loading wire:target="akta_kelahiran" class="text-xs text-blue-500 mt-1 italic">Mengupload...</div>
          @error('akta_kelahiran') <span class="text-red-500 text-sm block mt-1">{{ $message }}</span> @enderror
        </div>

        {{-- 2. KARTU KELUARGA --}}
        <div
          class="border border-gray-200 rounded-lg p-4 hover:border-green-400 transition-all {{ isset($existingDocuments['Kartu Keluarga']) ? 'bg-green-50 border-green-200' : 'bg-white' }}">
          <div class="flex justify-between items-center mb-2">
            <label class="font-semibold text-gray-700">2. Kartu Keluarga (KK)</label>
            @if(isset($existingDocuments['Kartu Keluarga']))
              <span class="px-3 py-1 bg-green-200 text-green-800 text-xs font-bold rounded-full flex items-center"><i
                  class="fa-solid fa-check mr-1"></i> Sudah Diupload</span>
            @endif
          </div>
          <input type="file" wire:model="kartu_keluarga"
            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-100 file:text-green-700 hover:file:bg-green-200">
          <div wire:loading wire:target="kartu_keluarga" class="text-xs text-blue-500 mt-1 italic">Mengupload...</div>
          @error('kartu_keluarga') <span class="text-red-500 text-sm block mt-1">{{ $message }}</span> @enderror
        </div>

        {{-- 3. KTP ORTU --}}
        <div
          class="border border-gray-200 rounded-lg p-4 hover:border-green-400 transition-all {{ isset($existingDocuments['KTP Ortu/Calon Santri']) ? 'bg-green-50 border-green-200' : 'bg-white' }}">
          <div class="flex justify-between items-center mb-2">
            <label class="font-semibold text-gray-700">3. KTP Orang Tua / Calon Santri</label>
            @if(isset($existingDocuments['KTP Ortu/Calon Santri']))
              <span class="px-3 py-1 bg-green-200 text-green-800 text-xs font-bold rounded-full flex items-center"><i
                  class="fa-solid fa-check mr-1"></i> Sudah Diupload</span>
            @endif
          </div>
          <input type="file" wire:model="ktp_ortu"
            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-100 file:text-green-700 hover:file:bg-green-200">
          @error('ktp_ortu') <span class="text-red-500 text-sm block mt-1">{{ $message }}</span> @enderror
        </div>

        {{-- 4. PAS FOTO --}}
        <div
          class="border border-gray-200 rounded-lg p-4 hover:border-green-400 transition-all {{ isset($existingDocuments['Pas Foto 3x4']) ? 'bg-green-50 border-green-200' : 'bg-white' }}">
          <div class="flex justify-between items-center mb-2">
            <label class="font-semibold text-gray-700">4. Pas Foto 3x4 (Latar Merah/Biru)</label>
            @if(isset($existingDocuments['Pas Foto 3x4']))
              <span class="px-3 py-1 bg-green-200 text-green-800 text-xs font-bold rounded-full flex items-center"><i
                  class="fa-solid fa-check mr-1"></i> Sudah Diupload</span>
            @endif
          </div>
          <input type="file" wire:model="pas_foto"
            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-100 file:text-green-700 hover:file:bg-green-200">
          @error('pas_foto') <span class="text-red-500 text-sm block mt-1">{{ $message }}</span> @enderror
        </div>

        {{-- 5. SURAT AKTIF SEKOLAH --}}
        <div
          class="border border-gray-200 rounded-lg p-4 hover:border-green-400 transition-all {{ isset($existingDocuments['Surat Keterangan Aktif Sekolah']) ? 'bg-green-50 border-green-200' : 'bg-white' }}">
          <div class="flex justify-between items-center mb-2">
            <label class="font-semibold text-gray-700">5. Surat Keterangan Aktif Sekolah Asal</label>
            @if(isset($existingDocuments['Surat Keterangan Aktif Sekolah']))
              <span class="px-3 py-1 bg-green-200 text-green-800 text-xs font-bold rounded-full flex items-center"><i
                  class="fa-solid fa-check mr-1"></i> Sudah Diupload</span>
            @endif
          </div>
          <input type="file" wire:model="surat_aktif_sekolah"
            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-100 file:text-green-700 hover:file:bg-green-200">
          @error('surat_aktif_sekolah') <span class="text-red-500 text-sm block mt-1">{{ $message }}</span> @enderror
        </div>
      </div>
    </div>

    {{-- BAGIAN 2: DOKUMEN AKADEMIK (DENGAN INPUT NOMOR) --}}
    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200">
      <div class="bg-gray-50 px-6 py-3 border-b border-gray-200">
        <h3 class="text-lg font-bold text-gray-700 flex items-center">
          <i class="fa-solid fa-graduation-cap mr-2 text-green-600"></i>
          Dokumen Akademik
        </h3>
      </div>
      <div class="p-6 space-y-6">
        {{-- 6. NISN & SKHUN --}}
        <div
          class="border border-gray-200 rounded-lg p-4 hover:border-green-400 transition-all {{ isset($existingDocuments['NISN & SKHUN']) ? 'bg-green-50 border-green-200' : 'bg-white' }}">
          <div class="flex justify-between items-center mb-2">
            <label class="font-semibold text-gray-700">6. Kartu NISN & SKHUN</label>
            @if(isset($existingDocuments['NISN & SKHUN']))
              <span class="px-3 py-1 bg-green-200 text-green-800 text-xs font-bold rounded-full flex items-center"><i
                  class="fa-solid fa-check mr-1"></i> Sudah Diupload</span>
            @endif
          </div>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <input type="file" wire:model="nisn_skhun"
                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-100 file:text-green-700 hover:file:bg-green-200">
              @error('nisn_skhun') <span class="text-red-500 text-sm block mt-1">{{ $message }}</span> @enderror
            </div>
            <div>
              <input type="text" wire:model="no_nisn_skhun" placeholder="Masukkan Nomor NISN"
                class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 text-sm">
              @error('no_nisn_skhun') <span class="text-red-500 text-sm block mt-1">{{ $message }}</span> @enderror
            </div>
          </div>
        </div>

        {{-- 7. IJAZAH --}}
        <div
          class="border border-gray-200 rounded-lg p-4 hover:border-green-400 transition-all {{ isset($existingDocuments['Ijazah']) ? 'bg-green-50 border-green-200' : 'bg-white' }}">
          <div class="flex justify-between items-center mb-2">
            <label class="font-semibold text-gray-700">7. Ijazah (Jika Sudah Ada)</label>
            @if(isset($existingDocuments['Ijazah']))
              <span class="px-3 py-1 bg-green-200 text-green-800 text-xs font-bold rounded-full flex items-center"><i
                  class="fa-solid fa-check mr-1"></i> Sudah Diupload</span>
            @endif
          </div>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <input type="file" wire:model="ijazah"
                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-100 file:text-green-700 hover:file:bg-green-200">
              @error('ijazah') <span class="text-red-500 text-sm block mt-1">{{ $message }}</span> @enderror
            </div>
            <div>
              <input type="text" wire:model="no_ijazah" placeholder="Masukkan Nomor Seri Ijazah"
                class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 text-sm">
            </div>
          </div>
        </div>

        {{-- 8. RAPOR --}}
        <div
          class="border border-gray-200 rounded-lg p-4 hover:border-green-400 transition-all {{ isset($existingDocuments['Rapor kelas 5-9']) ? 'bg-green-50 border-green-200' : 'bg-white' }}">
          <div class="flex justify-between items-center mb-2">
            <label class="font-semibold text-gray-700">8. Rapor Kelas 4, 5, 6 (Jadikan 1 file PDF)</label>
            @if(isset($existingDocuments['Rapor kelas 5-9']))
              <span class="px-3 py-1 bg-green-200 text-green-800 text-xs font-bold rounded-full flex items-center"><i
                  class="fa-solid fa-check mr-1"></i> Sudah Diupload</span>
            @endif
          </div>
          <input type="file" wire:model="rapor"
            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-100 file:text-green-700 hover:file:bg-green-200">
          <p class="text-xs text-gray-500 mt-1">*Upload halaman nilai pengetahuan & keterampilan saja.</p>
          @error('rapor') <span class="text-red-500 text-sm block mt-1">{{ $message }}</span> @enderror
        </div>
      </div>
    </div>

    {{-- BAGIAN 3: KHUSUS JALUR (CONDITIONAL) --}}
    @if ($jalurDaftar == 'Yatim' || $jalurDaftar == 'Dhuafa' || $jalurDaftar == 'Prestasi')
      <div class="bg-white rounded-xl shadow-md overflow-hidden border border-orange-200">
        <div class="bg-gradient-to-r from-orange-500 to-red-500 px-6 py-3">
          <h3 class="text-lg font-bold text-white flex items-center">
            <i class="fa-solid fa-star mr-2"></i>
            Dokumen Tambahan Jalur {{ $jalurDaftar }}
          </h3>
        </div>
        <div class="p-6 space-y-6">

          @if ($jalurDaftar == 'Yatim')
            <div
              class="border border-gray-200 rounded-lg p-4 hover:border-orange-400 transition-all {{ isset($existingDocuments['Surat Kematian Ortu/Bapak']) ? 'bg-green-50 border-green-200' : 'bg-orange-50' }}">
              <div class="flex justify-between items-center mb-2">
                <label class="font-semibold text-gray-800">Surat Kematian Orang Tua/Ayah <span
                    class="text-red-500">*</span></label>
                @if(isset($existingDocuments['Surat Kematian Ortu/Bapak']))
                  <span class="px-3 py-1 bg-green-200 text-green-800 text-xs font-bold rounded-full flex items-center"><i
                      class="fa-solid fa-check mr-1"></i> Sudah Diupload</span>
                @endif
              </div>
              <input type="file" wire:model="surat_kematian_ortu"
                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-100 file:text-orange-700 hover:file:bg-orange-200">
              @error('surat_kematian_ortu') <span class="text-red-500 text-sm block mt-1">{{ $message }}</span> @enderror
            </div>
          @endif

          @if ($jalurDaftar == 'Yatim' || $jalurDaftar == 'Dhuafa')
            <div
              class="border border-gray-200 rounded-lg p-4 hover:border-orange-400 transition-all {{ isset($existingDocuments['Surat Ket. Tidak Mampu']) ? 'bg-green-50 border-green-200' : 'bg-orange-50' }}">
              <div class="flex justify-between items-center mb-2">
                <label class="font-semibold text-gray-800">Surat Keterangan Tidak Mampu (SKTM) dari Kelurahan <span
                    class="text-red-500">*</span></label>
                @if(isset($existingDocuments['Surat Ket. Tidak Mampu']))
                  <span class="px-3 py-1 bg-green-200 text-green-800 text-xs font-bold rounded-full flex items-center"><i
                      class="fa-solid fa-check mr-1"></i> Sudah Diupload</span>
                @endif
              </div>
              <input type="file" wire:model="surat_keterangan_tdk_mampu"
                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-100 file:text-orange-700 hover:file:bg-orange-200">
              @error('surat_keterangan_tdk_mampu') <span class="text-red-500 text-sm block mt-1">{{ $message }}</span>
              @enderror
            </div>
          @endif

          @if ($jalurDaftar == 'Prestasi' || $jalurDaftar == 'Dhuafa')
            <div
              class="border border-gray-200 rounded-lg p-4 hover:border-orange-400 transition-all {{ isset($existingDocuments['Sertifikat Lomba/Hafalan']) ? 'bg-green-50 border-green-200' : 'bg-orange-50' }}">
              <div class="flex justify-between items-center mb-2">
                <label class="font-semibold text-gray-800">Sertifikat Prestasi / Hafalan Tahfidz <span
                    class="text-red-500">*</span></label>
                @if(isset($existingDocuments['Sertifikat Lomba/Hafalan']))
                  <span class="px-3 py-1 bg-green-200 text-green-800 text-xs font-bold rounded-full flex items-center"><i
                      class="fa-solid fa-check mr-1"></i> Sudah Diupload</span>
                @endif
              </div>
              <input type="file" wire:model="sertifikat_tambahan"
                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-100 file:text-orange-700 hover:file:bg-orange-200">
              @error('sertifikat_tambahan') <span class="text-red-500 text-sm block mt-1">{{ $message }}</span> @enderror
            </div>
          @endif

        </div>
      </div>
    @endif

    {{-- FOOTER ACTION --}}
    <div class="flex justify-end pt-4">
      <button type="submit" wire:loading.attr="disabled" wire:target="saveDocuments"
        class="bg-green-600 hover:bg-green-700 text-white font-bold px-8 py-4 rounded-lg shadow-lg transform transition hover:-translate-y-1 hover:shadow-xl flex items-center disabled:opacity-50 disabled:cursor-not-allowed">

        {{-- Text Normal --}}
        <span wire:loading.remove wire:target="saveDocuments" class="flex items-center">
          <i class="fa-solid fa-cloud-upload-alt mr-3 text-xl"></i>
          Simpan & Upload Dokumen
        </span>

        {{-- Loading Spinner --}}
        <span wire:loading wire:target="saveDocuments" class="flex items-center">
          <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor"
              d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
            </path>
          </svg>
          Sedang Mengupload...
        </span>
      </button>
    </div>
  </form>
</div>