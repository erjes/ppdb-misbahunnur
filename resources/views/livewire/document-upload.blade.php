    <div>
        <h1>Form Upload Dokumen Persyaratan</h1>

        @if (session()->has('message'))
            <p>{{ session('message') }}</p>
        @endif

        <form wire:submit.prevent="saveDocuments" enctype="multipart/form-data">

            {{-- 1. Fotokopi Akta Kelahiran --}}
            <div>
                <label>Fotokopi Akta Kelahiran (2 lembar)</label>
                <input type="file" wire:model="akta_kelahiran">
                @error('akta_kelahiran') <p>{{ $message }}</p> @enderror
                @if ($akta_kelahiran)
                    <p>File siap: {{ $akta_kelahiran->getClientOriginalName() }}</p>
                @endif
            </div>

            {{-- 2. Fotokopi Kartu Keluarga --}}
            <div>
                <label>Fotokopi Kartu Keluarga (2 lembar)</label>
                <input type="file" wire:model="kartu_keluarga">
                @error('kartu_keluarga') <p>{{ $message }}</p> @enderror
                @if ($kartu_keluarga)
                    <p>File siap: {{ $kartu_keluarga->getClientOriginalName() }}</p>
                @endif
            </div>

            {{-- 3. Fotokopi KTP Ortu --}}
            <div>
                <label>Fotokopi KTP Orang Tua/Calon Santri (2 lembar)</label>
                <input type="file" wire:model="ktp_ortu">
                @error('ktp_ortu') <p>{{ $message }}</p> @enderror
                @if ($ktp_ortu)
                    <p>File siap: {{ $ktp_ortu->getClientOriginalName() }}</p>
                @endif
            </div>

            {{-- 4. Fotokopi NISN & SKHUN --}}
            <div>
                <label>Fotokopi NISN & SKHUN (2 lembar)</label>
                <input type="text" wire:model="no_nisn_skhun" placeholder="No. NISN">
                @error('no_nisn_skhun') <p>{{ $message }}</p> @enderror

                <input type="file" wire:model="nisn_skhun">
                @error('nisn_skhun') <p>{{ $message }}</p> @enderror
                @if ($nisn_skhun)
                    <p>File siap: {{ $nisn_skhun->getClientOriginalName() }}</p>
                @endif
            </div>

            {{-- 5. Fotokopi Ijazah --}}
            <div>
                <label>Fotokopi Ijazah (2 lembar)</label>
                <input type="text" wire:model="no_ijazah" placeholder="No. Ijazah">
                @error('no_ijazah') <p>{{ $message }}</p> @enderror

                <input type="file" wire:model="ijazah">
                @error('ijazah') <p>{{ $message }}</p> @enderror
                @if ($ijazah)
                    <p>File siap: {{ $ijazah->getClientOriginalName() }}</p>
                @endif
            </div>

            {{-- 6. Rapor kelas 5–9 --}}
            <div>
                <label>Rapor kelas 5–6 SD/MI atau 8–9 SMP/MTs (2 lembar)</label>
                <input type="file" wire:model="rapor">
                @error('rapor') <p>{{ $message }}</p> @enderror
                @if ($rapor)
                    <p>File siap: {{ $rapor->getClientOriginalName() }}</p>
                @endif
            </div>

            {{-- 7. Pas foto 3x4 --}}
            <div>
                <label>Pas foto 3x4 (masing-masing 3 lembar)</label>
                <input type="file" wire:model="pas_foto">
                @error('pas_foto') <p>{{ $message }}</p> @enderror
                @if ($pas_foto)
                    <p>File siap: {{ $pas_foto->getClientOriginalName() }}</p>
                @endif
            </div>

            {{-- 8. Surat Keterangan Aktif Sekolah --}}
            <div>
                <label>Surat Keterangan Aktif Sekolah</label>
                <input type="file" wire:model="surat_aktif_sekolah">
                @error('surat_aktif_sekolah') <p>{{ $message }}</p> @enderror
                @if ($surat_aktif_sekolah)
                    <p>File siap: {{ $surat_aktif_sekolah->getClientOriginalName() }}</p>
                @endif
            </div>

            <button type="submit">Simpan dan Unggah Semua Dokumen</button>
        </form>
    </div>
