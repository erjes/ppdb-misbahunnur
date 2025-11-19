<div>
    <h2>
        {{ $isEditing ? 'Edit Poster' : 'Unggah Poster Baru' }}
    </h2>

    @if (session()->has('message'))
        <div style="color: green; margin-bottom: 15px;">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="uploadPoster">

        <div>
            <label for="title">Judul Poster:</label><br>
            <input id="title" type="text" wire:model="title" placeholder="Masukkan judul poster">
            @error('title') <span style="color: red;">{{ $message }}</span> @enderror
        </div>
        <br>

        <div>
            <label for="poster">
                {{ $isEditing ? 'Upload Poster Baru (Kosongkan jika tidak diubah)' : 'Upload Poster' }}:
            </label><br>
            <input id="poster" type="file" wire:model="poster">
            @error('poster') <span style="color: red;">{{ $message }}</span> @enderror
        </div>
        <br>

        @if ($poster)
            <div>
                <p>Pratinjau File Baru:</p>
                <img src="{{ $poster->temporaryUrl() }}" height="200" alt="Preview Baru">
            </div>
            <br>
        @elseif ($isEditing && $oldFilename)
            <div>
                <p>Poster Saat Ini:</p>
                <img src="{{ asset('storage/' . $oldFilename) }}" height="200" alt="Poster Lama">
            </div>
            <br>
        @endif

        <div>
            <button type="submit">
                {{ $isEditing ? 'Simpan Perubahan' : 'Upload Poster' }}
            </button>

            @if ($isEditing)
                <button type="button" wire:click="cancelEdit">
                    Batal
                </button>
            @endif
        </div>
    </form>

    <hr>

    <h3>Daftar Poster Tersimpan ({{ $posters->count() }})</h3>

    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%;">
        <thead>
            <tr>
                <th>Pratinjau</th>
                <th>Judul</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($posters as $posterItem)
                <tr>
                    <td>
                        <img src="{{ asset('storage/' . $posterItem->filename) }}" alt="Poster" height="100">
                    </td>
                    <td>
                        {{ $posterItem->title ?? '(Tanpa Judul)' }}
                    </td>
                    <td>
                        <button wire:click="edit({{ $posterItem->id }})">Edit</button>

                        <button wire:click="deletePoster({{ $posterItem->id }})"
                            onclick="confirm('Yakin ingin menghapus poster ini? File juga akan dihapus dari storage.') || event.stopImmediatePropagation()">
                            Hapus
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" style="text-align: center;">Belum ada poster yang diunggah.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>