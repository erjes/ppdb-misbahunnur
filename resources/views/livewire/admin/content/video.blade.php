<div>
    <h2>
        {{ $isEditing ? 'Edit URL Video' : 'Unggah URL Video Baru' }}
    </h2>

    {{-- Flash Message --}}
    @if (session()->has('message'))
        <div style="color: green; margin-bottom: 15px;">
            <strong>{{ session('message') }}</strong>
        </div>
    @endif

    <form wire:submit.prevent="{{ $isEditing ? 'updateVideo' : 'uploadVideo' }}">

        <div>
            <label for="title">Judul Video:</label><br>
            <input id="title" type="text" wire:model="title" placeholder="Masukkan judul video" required>
            @error('title') <span style="color: red;">{{ $message }}</span> @enderror
        </div>
        <br>

        <div>
            <label for="videoUrl">URL Video YouTube:</label><br>
            <input id="videoUrl" type="url" wire:model.live="videoUrl" placeholder="Masukkan URL video YouTube"
                required>
            @error('videoUrl') <span style="color: red;">{{ $message }}</span> @enderror
        </div>
        <br>

        @if ($currentEmbedUrl)
            <div>
                <p>Pratinjau Video:</p>
                <iframe width="400" height="225" src="{{ $currentEmbedUrl }}" frameborder="0"
                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                </iframe>
            </div>
            <br>
        @endif

        <div>
            <button type="submit">
                {{ $isEditing ? 'Simpan Perubahan' : 'Unggah URL Video' }}
            </button>

            @if ($isEditing)
                <button type="button" wire:click="cancelEdit">
                    Batal
                </button>
            @endif
        </div>
    </form>

    <hr>

    <h3>Daftar Video Tersimpan ({{ $videos->count() }})</h3>

    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%;">
        <thead>
            <tr>
                <th>Pratinjau</th>
                <th>Judul</th>
                <th>URL</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($videos as $video)
                <tr>
                    <td>
                        @php
                            $thumbnail = $this->getThumbnailUrl($video->filename);
                        @endphp
                        @if ($thumbnail)
                            <img src="{{ $thumbnail }}" alt="Thumbnail" height="80">
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
                        {{ $video->title ?? '(Tanpa Judul)' }}
                    </td>
                    <td>
                        <a href="{{ $video->filename }}" target="_blank">
                            {{ Str::limit($video->filename, 40) }}
                        </a>
                    </td>
                    <td>
                        <button wire:click="edit({{ $video->id }})">Edit</button>

                        <button wire:click="deleteVideo({{ $video->id }})"
                            onclick="confirm('Yakin ingin menghapus video ini?') || event.stopImmediatePropagation()">
                            Hapus
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align: center;">Belum ada URL video yang diunggah.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>