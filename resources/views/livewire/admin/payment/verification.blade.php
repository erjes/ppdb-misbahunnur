<div>
    <h2>Verifikasi Pembayaran</h2>

    <div>
        <strong>Nomor Pendaftaran:</strong> {{ $payment->student->nomor_pendaftaran }} <br>
        <strong>Nama:</strong> {{ $payment->student->nama_lengkap }} <br>
        <strong>Jumlah Pembayaran:</strong> Rp. {{ number_format($payment->jumlah, 0, ',', '.') }} <br>
        <strong>Tanggal Pembayaran:</strong> {{ \Carbon\Carbon::parse($payment->tanggal_bayar)->format('d F Y') }} <br>
    </div>

    <div class="mt-3">
        <h4>Bukti Pembayaran:</h4>
        <img src="{{ asset('storage/payments/' . $payment->file_path) }}" alt="Bukti Pembayaran" width="300" class="mb-3">
    </div>

    <div class="mt-3">
        <label>
            <input type="checkbox" wire:model="isPaid"> Terverifikasi
        </label>
    </div>

    <button wire:click="updatePaymentStatus" class="btn btn-success mt-3">Update Status Pembayaran</button>

    @if (session()->has('message'))
        <div class="alert alert-success mt-3">{{ session('message') }}</div>
    @endif
</div>
