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
    <div class="bg-gradient-to-r from-red-600 to-red-700 px-6 py-4">
      <h2 class="text-xl font-bold text-white flex items-center">
        <i class="fa-brands {{ $isEditing ? 'fa-youtube' : 'fa-youtube' }} mr-3"></i>
        {{ $isEditing ? 'Edit URL Video' : 'Unggah URL Video Baru' }}
      </h2>
    </div>
    <div class="p-6">
      <form wire:submit.prevent="{{ $isEditing ? 'updateVideo' : 'uploadVideo' }}" class="space-y-6">
        <div>
          <label for="title" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
            <i class="fa-solid fa-heading text-red-600 mr-2"></i>
            Judul Video
          </label>
          <input id="title" type="text" wire:model="title" placeholder="Masukkan judul video" required
            class="block w-full bg-white border-2 border-red-300 focus:border-red-500 focus:ring-4 focus:ring-red-100 rounded-lg shadow-sm text-gray-700 py-3 px-4 transition-all">
          @error('title')
            <p class="text-red-600 text-sm mt-2 flex items-center">
              <i class="fa-solid fa-exclamation-circle mr-1"></i>{{ $message }}
            </p>
          @enderror
        </div>

        <div>
          <label for="videoUrl" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
            <i class="fa-solid fa-link text-red-600 mr-2"></i>
            URL Video YouTube
          </label>
          <input id="videoUrl" type="url" wire:model.live="videoUrl" placeholder="Masukkan URL video YouTube"
            required
            class="block w-full bg-white border-2 border-red-300 focus:border-red-500 focus:ring-4 focus:ring-red-100 rounded-lg shadow-sm text-gray-700 py-3 px-4 transition-all">
          @error('videoUrl')
            <p class="text-red-600 text-sm mt-2 flex items-center">
              <i class="fa-solid fa-exclamation-circle mr-1"></i>{{ $message }}
            </p>
          @enderror
        </div>

        @if ($currentEmbedUrl)
          <div class="border-2 border-red-200 rounded-lg p-4 bg-red-50/30">
            <p class="text-sm font-medium text-gray-700 mb-3 flex items-center">
              <i class="fa-solid fa-play-circle text-red-600 mr-2"></i>
              Pratinjau Video
            </p>
            <div class="relative" style="padding-bottom: 56.25%; height: 0;">
              <iframe src="{{ $currentEmbedUrl }}" class="absolute top-0 left-0 w-full h-full rounded-lg shadow-md"
                frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen>
              </iframe>
            </div>
          </div>
        @endif

        <div class="flex gap-3">
          <button type="submit"
            class="flex-1 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-semibold px-6 py-3 rounded-lg shadow-md transition-all duration-300 transform hover:-translate-y-0.5 flex items-center justify-center">
            <i class="fa-solid {{ $isEditing ? 'fa-save' : 'fa-upload' }} mr-2"></i>
            {{ $isEditing ? 'Simpan Perubahan' : 'Unggah URL Video' }}
          </button>

          @if ($isEditing)
            <button type="button" wire:click="cancelEdit"
              class="flex-1 bg-gray-500 hover:bg-gray-600 text-white font-semibold px-6 py-3 rounded-lg shadow-md transition-all duration-300 transform hover:-translate-y-0.5 flex items-center justify-center">
              <i class="fa-solid fa-times mr-2"></i>
              Batal
            </button>
          @endif
        </div>
      </form>
    </div>
  </div>

  <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200">
    <div class="bg-gradient-to-r from-purple-600 to-purple-700 px-6 py-4">
      <h3 class="text-lg font-bold text-white flex items-center">
        <i class="fa-solid fa-video mr-3"></i>
        Daftar Video Tersimpan ({{ $videos->count() }} video)
      </h3>
    </div>
    <div class="p-6">
      @if ($videos->count() > 0)
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
          @foreach ($videos as $video)
            <div
              class="border-2 border-gray-200 rounded-xl overflow-hidden hover:border-purple-400 hover:shadow-lg transition-all duration-300 bg-gradient-to-br from-white to-purple-50/30">
              <div class="relative group">
                @php
                  $thumbnail = $this->getThumbnailUrl($video->filename);
                @endphp
                @if ($thumbnail)
                  <img src="{{ $thumbnail }}" alt="Thumbnail" class="w-full h-48 object-cover">
                  <div
                    class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-60 transition-all duration-300 flex items-center justify-center">
                    <div class="transform scale-0 group-hover:scale-100 transition-transform duration-300">
                      <a href="{{ $video->filename }}" target="_blank"
                        class="bg-white text-purple-600 px-4 py-2 rounded-lg font-semibold shadow-xl flex items-center">
                        <i class="fa-solid fa-play mr-2"></i>
                        Tonton Video
                      </a>
                    </div>
                  </div>
                @else
                  <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                    <i class="fa-solid fa-video text-gray-400 text-4xl"></i>
                  </div>
                @endif
              </div>

              <div class="p-4">
                <h4 class="font-semibold text-gray-800 mb-2 flex items-center">
                  <i class="fa-solid fa-heading text-purple-600 mr-2"></i>
                  {{ $video->title ?? '(Tanpa Judul)' }}
                </h4>

                <div class="mb-3 text-sm text-gray-600 flex items-center">
                  <i class="fa-solid fa-link text-purple-600 mr-2"></i>
                  <a href="{{ $video->filename }}" target="_blank"
                    class="hover:text-purple-600 hover:underline truncate">
                    {{ Str::limit($video->filename, 40) }}
                  </a>
                </div>

                <div class="flex gap-2">
                  <button wire:click="edit({{ $video->id }})"
                    class="flex-1 bg-purple-600 hover:bg-purple-700 text-white font-medium px-4 py-2 rounded-lg shadow transition-all duration-300 transform hover:-translate-y-0.5 flex items-center justify-center">
                    <i class="fa-solid fa-pen mr-1"></i>
                    Edit
                  </button>
                  <button wire:click="deleteVideo({{ $video->id }})"
                    onclick="return confirm('Yakin ingin menghapus video ini?')"
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
          <i class="fa-brands fa-youtube text-gray-300 text-6xl mb-4"></i>
          <h4 class="text-xl font-semibold text-gray-600 mb-2">Belum Ada Video</h4>
          <p class="text-gray-500">Mulai tambahkan URL video YouTube pertama Anda</p>
        </div>
      @endif
    </div>
  </div>
</div>
