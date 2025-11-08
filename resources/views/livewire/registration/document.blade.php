<div>
    <h1>Form Upload Dokumen Persyaratan (Jalur: {{ $jalurDaftar }})</h1>

    @if (session()->has('message'))
        <p style="color: green;">{{ session('message') }}</p>
    @endif

    <form wire:submit.prevent="saveDocuments" enctype="multipart/form-data">

        <div>
            <label>1. Akta Kelahiran</label>
            <input type="file" wire:model="akta_kelahiran">
            @error('akta_kelahiran') <p style="color: red;">{{ $message }}</p> @enderror
        </div>

        <div>
            <label>2. Kartu Keluarga </label>
            <input type="file" wire:model="kartu_keluarga">
            @error('kartu_keluarga') <p style="color: red;">{{ $message }}</p> @enderror
        </div>

        <div>
            <label>3. KTP Orang Tua/Calon Santri</label>
            <input type="file" wire:model="ktp_ortu">
            @error('ktp_ortu') <p style="color: red;">{{ $message }}</p> @enderror
        </div>

        <div>
            <label>4. Pas Foto Berwarna 3x4 </label>
            <input type="file" wire:model="pas_foto">
            @error('pas_foto') <p style="color: red;">{{ $message }}</p> @enderror
        </div>

        <div>
            <label>5. Ijazah / Surat Keterangan Lulus </label>
            <input type="file" wire:model="ijazah_skl">
            @error('ijazah_skl') <p style="color: red;">{{ $message }}</p> @enderror
        </div>

        <div>
            <label>6. Kartu NISN & SKHUN</label>
            <input type="file" wire:model="kartu_nisn">
            @error('kartu_nisn') <p style="color: red;">{{ $message }}</p> @enderror
        </div>

        <div>
            <label>7. Rapor Kelas 4, 5, 6 Semester Ganjil/Genap</label>
            <input type="file" wire:model="rapor">
            @error('rapor') <p style="color: red;">{{ $message }}</p> @enderror
        </div>

        <div>
            <label>8. Surat Keterangan Aktif Sekolah/Madrasah Asal</label>
            <input type="file" wire:model="surat_aktif_sekolah">
            @error('surat_aktif_sekolah') <p style="color: red;">{{ $message }}</p> @enderror
        </div>

        <hr style="margin: 20px 0; border-top: 1px solid #ccc;">

        <h2>Persyaratan Tambahan Jalur Khusus</h2>

        @if ($jalurDaftar == 'Yatim')
            <div wire:key="dok-yatim">
                <h3>Dokumen Yatim (Wajib)</h3>

                <div>
                    <label>Surat Kematian Orang Tua/Bapak</label>
                    <input type="file" wire:model="surat_kematian_ortu">
                    @error('surat_kematian_ortu') <p style="color: red;">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label>Surat Keterangan Tidak Mampu (SKTM) dari Kelurahan</label>
                    <input type="file" wire:model="surat_keterangan_tdk_mampu">
                    @error('surat_keterangan_tdk_mampu') <p style="color: red;">{{ $message }}</p> @enderror
                </div>
            </div>
        @endif

        @if ($jalurDaftar == 'Dhuafa' || $jalurDaftar == 'Prestasi')
            <div wire:key="dok-prestasi-dhuafa">
                <h3>Dokumen {{ $jalurDaftar }} (Wajib)</h3>

                @if ($jalurDaftar == 'Dhuafa')
                    <div>
                        <label>Surat Keterangan Tidak Mampu (SKTM) dari Kelurahan</label>
                        <input type="file" wire:model="surat_keterangan_tdk_mampu">
                        @error('surat_keterangan_tdk_mampu') <p style="color: red;">{{ $message }}</p> @enderror
                    </div>
                @endif

                <div>
                    <label>Sertifikat Kompetisi / Lomba, Hafalan 5 Juz, atau Transkrip Ranking 1/2</label>
                    <input type="file" wire:model="sertifikat_tambahan">
                    @error('sertifikat_tambahan') <p style="color: red;">{{ $message }}</p> @enderror
                </div>
            </div>
        @endif

        <hr style="margin: 20px 0; border-top: 1px solid #ccc;">

        <button type="submit">Simpan dan Unggah Semua Dokumen</button>
    </form>
</div>