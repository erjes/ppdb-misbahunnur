<div>
    <h2>Pengaturan Template Surat Kelulusan</h2>

    {{-- Flash Message --}}
    @if (session()->has('message'))
        <div style="margin-bottom: 15px; color: green;">
            <strong>{{ session('message') }}</strong>
        </div>
    @endif

    <form wire:submit.prevent="saveSettings">

        <hr>
        <h3>1. Header & Identitas Surat</h3>

        <div>
            <label>Nomor SK:</label><br>
            <input type="text" wire:model="sk_number" placeholder="Contoh: 01/PAN-PPDB/SK/XII/2023">
            @error('sk_number') <span style="color: red;">{{ $message }}</span> @enderror
        </div>
        <br>

        <div>
            <label>Tanggal Surat (Teks):</label><br>
            <input type="text" wire:model="date" placeholder="Contoh: 13 Desember 2023">
        </div>
        <br>

        <div>
            <label>Tahun Pelajaran:</label><br>
            <input type="text" wire:model="school_year" placeholder="Contoh: 2024-2025">
        </div>

        <hr>
        <h3>2. Penandatangan & Legalitas</h3>

        <div>
            <label>Nama Penandatangan:</label><br>
            <input type="text" wire:model="signer_name">
            @error('signer_name') <span style="color: red;">{{ $message }}</span> @enderror
        </div>
        <br>

        <div>
            <label>Jabatan:</label><br>
            <input type="text" wire:model="signer_title">
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

        <hr>
        <h3>3. Isi Surat Keputusan (Halaman 1)</h3>

        <div>
            <label>Menimbang (Pisahkan dengan Enter):</label><br>
            <textarea wire:model="content_menimbang" rows="5" cols="50"></textarea>
        </div>
        <br>

        <div>
            <label>Memperhatikan (Pisahkan dengan Enter):</label><br>
            <textarea wire:model="content_memperhatikan" rows="5" cols="50"></textarea>
        </div>

        <hr>
        <h3>4. Informasi Pembayaran (Halaman 2)</h3>

        <div>
            <label>Mulai Pembayaran Tahap 1:</label><br>
            <input type="text" wire:model="payment_deadline_1_start">
        </div>
        <br>

        <div>
            <label>Akhir Pembayaran Tahap 1:</label><br>
            <input type="text" wire:model="payment_deadline_1_end">
        </div>
        <br>

        <div>
            <label>Akhir Pembayaran Tahap 2:</label><br>
            <input type="text" wire:model="payment_deadline_2_end">
        </div>
        <br>

        <div>
            <label>Info Rekening Bank:</label><br>
            <textarea wire:model="bank_account_info" rows="3" cols="50"></textarea>
        </div>
        <br>

        <hr>
        <button type="submit">
            <span wire:loading.remove wire:target="saveSettings">Simpan Perubahan</span>
            <span wire:loading wire:target="saveSettings">Menyimpan...</span>
        </button>

    </form>
</div>