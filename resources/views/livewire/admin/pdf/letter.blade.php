<div>
    <h2>Pengaturan Template Surat Kelulusan</h2>

    {{-- Flash Message --}}
    @if (session()->has('message'))
        <div style="margin-bottom: 15px; color: green;">
            <strong>{{ session('message') }}</strong>
        </div>
    @endif

    <form wire:submit.prevent="saveSettings">

        {{-- BAGIAN 1 --}}
        <hr>
        <h3>1. Header & Identitas Surat</h3>

        <div>
            <label>Nomor SK:</label><br>
            <input type="text" wire:model="sk_number" placeholder="Contoh: 01/PAN-PPDB/SK/XII/2023"
                style="width: 100%;">
            @error('sk_number') <span style="color: red;">{{ $message }}</span> @enderror
        </div>
        <br>

        <div>
            <label>Tanggal Surat (Teks):</label><br>
            <input type="text" wire:model="date" placeholder="Contoh: 13 Desember 2023" style="width: 100%;">
        </div>
        <br>

        <div>
            <label>Tahun Pelajaran:</label><br>
            <input type="text" wire:model="school_year" placeholder="Contoh: 2024-2025" style="width: 100%;">
        </div>

        {{-- BAGIAN 2 --}}
        <hr>
        <h3>2. Penandatangan & Legalitas</h3>

        <div>
            <label>Nama Penandatangan:</label><br>
            <input type="text" wire:model="signer_name" style="width: 100%;">
            @error('signer_name') <span style="color: red;">{{ $message }}</span> @enderror
        </div>
        <br>

        <div>
            <label>Jabatan:</label><br>
            <input type="text" wire:model="signer_title" style="width: 100%;">
        </div>
        <br>

        <div>
            <label>File Tanda Tangan (PNG):</label><br>
            <input type="file" wire:model="signature_image">
            <span wire:loading wire:target="signature_image">Uploading...</span>

            <div style="margin-top: 10px;">
                @if ($signature_image)
                    <p>Preview Baru:</p>
                    <img src="{{ $signature_image->temporaryUrl() }}" height="100">
                @elseif ($existing_signature)
                    <p>File Saat Ini:</p>
                    <img src="{{ Storage::url($existing_signature) }}" height="100">
                @endif
            </div>
        </div>
        <br>

        <div>
            <label>File Stempel (PNG):</label><br>
            <input type="file" wire:model="stamp_image">
            <span wire:loading wire:target="stamp_image">Uploading...</span>

            <div style="margin-top: 10px;">
                @if ($stamp_image)
                    <p>Preview Baru:</p>
                    <img src="{{ $stamp_image->temporaryUrl() }}" height="100">
                @elseif ($existing_stamp)
                    <p>File Saat Ini:</p>
                    <img src="{{ Storage::url($existing_stamp) }}" height="100">
                @endif
            </div>
        </div>

        {{-- BAGIAN 3 --}}
        <hr>
        <h3>3. Isi Surat Keputusan (Halaman 1)</h3>

        <div>
            <label>Menimbang (Pisahkan dengan Enter):</label><br>
            <textarea wire:model="content_menimbang" rows="5" style="width: 100%;"></textarea>
        </div>
        <br>

        <div>
            <label>Memperhatikan (Pisahkan dengan Enter):</label><br>
            <textarea wire:model="content_memperhatikan" rows="5" style="width: 100%;"></textarea>
        </div>

        {{-- BAGIAN 4 --}}
        <hr>
        <h3>4. Konten Halaman 2 (Pemberitahuan)</h3>
        <p style="font-size: small; color: gray;">Gunakab [TAHUN] dalam teks agar otomatis diganti
            dengan Tahun Pelajaran.</p>

        <div>
            <label>Paragraf Pembuka:</label><br>
            <textarea wire:model="p2_opening" rows="2" style="width: 100%;"></textarea>
        </div>
        <br>

        <div>
            <label>Paragraf Kondisi (Diterima apabila...):</label><br>
            <textarea wire:model="p2_conditional" rows="2" style="width: 100%;"></textarea>
        </div>
        <br>

        <div>
            <label>List Poin 1 - Kelengkapan Data (Pisahkan dengan Enter):</label><br>
            <textarea wire:model="p2_requirements" rows="3" style="width: 100%;"></textarea>
        </div>
        <br>

        <div>
            <label>List Poin 2 - Ketentuan Pembayaran (Pisahkan dengan Enter):</label><br>
            <textarea wire:model="p2_payment_terms" rows="5" style="width: 100%;"></textarea>
        </div>
        <br>

        <div>
            <label>Intro Pengunduran Diri:</label><br>
            <input type="text" wire:model="p2_resign_intro" style="width: 100%;">
        </div>
        <br>

        <div>
            <label>List Poin Pengunduran Diri (Pisahkan dengan Enter):</label><br>
            <textarea wire:model="p2_resign_points" rows="6" style="width: 100%;"></textarea>
        </div>
        <br>

        <div>
            <label>Paragraf Penutup:</label><br>
            <textarea wire:model="p2_closing" rows="2" style="width: 100%;"></textarea>
        </div>
        <br>

        <div>
            <label>Footer / NB (Info Rekening):</label><br>
            <textarea wire:model="p2_footer_note" rows="3" style="width: 100%;"></textarea>
        </div>
        <br>

        <hr>
        <button type="submit"
            style="padding: 10px 20px; background-color: blue; color: white; border: none; cursor: pointer; margin-bottom: 50px;">
            <span wire:loading.remove wire:target="saveSettings">Simpan Semua Perubahan</span>
            <span wire:loading wire:target="saveSettings">Menyimpan...</span>
        </button>

    </form>
</div>