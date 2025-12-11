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
        <i class="fa-solid {{ $isEditing ? 'fa-pen-to-square' : 'fa-cloud-upload' }} mr-3"></i>
        {{ $isEditing ? 'Edit Poster' : 'Unggah Poster Baru' }}
      </h2>
    </div>
    <div class="p-6">
      <form wire:submit.prevent="uploadPoster" class="space-y-6">
        <div>
          <label for="title" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
            <i class="fa-solid fa-heading text-green-600 mr-2"></i>
            Judul Poster
          </label>
          <input id="title" type="text" wire:model="title" placeholder="Masukkan judul poster"
            class="block w-full bg-white border-2 border-green-300 focus:border-green-500 focus:ring-4 focus:ring-green-100 rounded-lg shadow-sm text-gray-700 py-3 px-4 transition-all">
          @error('title')
            <p class="text-red-600 text-sm mt-2 flex items-center">
              <i class="fa-solid fa-exclamation-circle mr-1"></i>{{ $message }}
            </p>
          @enderror
        </div>

        <div>
          <label for="poster" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
            <i class="fa-solid fa-image text-green-600 mr-2"></i>
            {{ $isEditing ? 'Upload Poster Baru (Kosongkan jika tidak diubah)' : 'Upload Poster' }}
          </label>
          <input id="poster" type="file" wire:model="poster"
            class="block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-green-100 file:text-green-700 hover:file:bg-green-200 transition-all">

          {{-- Loading indikator khusus saat file sedang diupload ke temporary --}}
          <div wire:loading wire:target="poster" class="text-sm text-green-600 mt-2 font-medium flex items-center">
            <i class="fa-solid fa-spinner fa-spin mr-2"></i> Mengupload file...
          </div>

          @error('poster')
            <p class="text-red-600 text-sm mt-2 flex items-center">
              <i class="fa-solid fa-exclamation-circle mr-1"></i>{{ $message }}
            </p>
          @enderror
        </div>

        @if ($poster)
          <div class="border-2 border-green-200 rounded-lg p-4 bg-green-50/30">
            <p class="text-sm font-medium text-gray-700 mb-3 flex items-center">
              <i class="fa-solid fa-eye text-green-600 mr-2"></i>
              Pratinjau File Baru
            </p>
            <img src="{{ $poster->temporaryUrl() }}" alt="Preview Baru"
              class="max-h-64 rounded-lg shadow-md border-2 border-green-300">
          </div>
        @elseif ($isEditing && $oldFilename)
          <div class="border-2 border-green-200 rounded-lg p-4 bg-green-50/30">
            <p class="text-sm font-medium text-gray-700 mb-3 flex items-center">
              <i class="fa-solid fa-image text-green-600 mr-2"></i>
              Poster Saat Ini
            </p>
            <img src="{{ asset('storage/' . $oldFilename) }}" alt="Poster Lama"
              class="max-h-64 rounded-lg shadow-md border-2 border-green-300">
          </div>
        @endif

        <div class="flex gap-3">

          {{-- TOMBOL SUBMIT DENGAN LOADING STATE --}}
          <button type="submit" wire:loading.attr="disabled" wire:target="uploadPoster, poster"
            class="flex-1 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-semibold px-6 py-3 rounded-lg shadow-md transition-all duration-300 transform hover:-translate-y-0.5 flex items-center justify-center disabled:opacity-50 disabled:cursor-not-allowed">

            {{-- Tampilan Normal --}}
            <span wire:loading.remove wire:target="uploadPoster, poster" class="flex items-center">
              <i class="fa-solid {{ $isEditing ? 'fa-save' : 'fa-upload' }} mr-2"></i>
              {{ $isEditing ? 'Simpan Perubahan' : 'Upload Poster' }}
            </span>

            {{-- Tampilan Loading --}}
            <span wire:loading wire:target="uploadPoster, poster" class="flex items-center">
              <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor"
                  d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                </path>
              </svg>
              {{ $isEditing ? 'Menyimpan...' : 'Mengupload...' }}
            </span>
          </button>

          @if ($isEditing)
            <button type="button" wire:click="cancelEdit" wire:loading.attr="disabled"
              class="flex-1 bg-gray-500 hover:bg-gray-600 text-white font-semibold px-6 py-3 rounded-lg shadow-md transition-all duration-300 transform hover:-translate-y-0.5 flex items-center justify-center disabled:opacity-50">
              <i class="fa-solid fa-times mr-2"></i>
              Batal
            </button>
          @endif
        </div>
      </form>
    </div>
  </div>

  <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200">
    <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
      <h3 class="text-lg font-bold text-white flex items-center">
        <i class="fa-solid fa-images mr-3"></i>
        Daftar Poster Tersimpan ({{ $posters->count() }} poster)
      </h3>
    </div>
    <div class="p-6">
      @if ($posters->count() > 0)
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
          @foreach ($posters as $posterItem)
            <div
              class="border-2 border-gray-200 rounded-xl overflow-hidden hover:border-blue-400 hover:shadow-lg transition-all duration-300 bg-gradient-to-br from-white to-blue-50/30">
              <div class="relative group">
                <img src="{{ asset('storage/' . $posterItem->filename) }}" alt="Poster" class="w-full h-64 object-cover">
                <div
                  class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all duration-300 flex items-center justify-center">
                  <div class="transform scale-0 group-hover:scale-100 transition-transform duration-300">
                    <a href="{{ asset('storage/' . $posterItem->filename) }}" target="_blank"
                      class="bg-white text-blue-600 px-4 py-2 rounded-lg font-semibold shadow-xl flex items-center">
                      <i class="fa-solid fa-expand mr-2"></i>
                      Lihat Penuh
                    </a>
                  </div>
                </div>
              </div>

              <div class="p-4">
                <h4 class="font-semibold text-gray-800 mb-3 flex items-center">
                  <i class="fa-solid fa-tag text-blue-600 mr-2"></i>
                  {{ $posterItem->title ?? '(Tanpa Judul)' }}
                </h4>

                <div class="flex gap-2">
                  <button wire:click="edit({{ $posterItem->id }})"
                    class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded-lg shadow transition-all duration-300 transform hover:-translate-y-0.5 flex items-center justify-center">
                    <i class="fa-solid fa-pen mr-1"></i>
                    Edit
                  </button>
                  <button wire:click="deletePoster({{ $posterItem->id }})"
                    onclick="return confirm('Yakin ingin menghapus poster ini? File juga akan dihapus dari storage.')"
                    class="flex-1 bg-red-600 hover:bg-red-700 text-white font-medium px-4 py-2 rounded-lg shadow transition-all duration-300 transform hover:-translate-y-0.5 flex items-center justify-center">
                    <i class="fa-solid fa-trash mr-1"></i>
                    Hapus
                  </button>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      @else
        <div class="text-center py-12">
          <i class="fa-solid fa-image text-gray-300 text-6xl mb-4"></i>
          <h4 class="text-xl font-semibold text-gray-600 mb-2">Belum Ada Poster</h4>
          <p class="text-gray-500">Mulai upload poster pertama Anda</p>
        </div>
      @endif
    </div>
  </div>
</div>