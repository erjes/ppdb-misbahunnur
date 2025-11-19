<div>
    <h2>Verifikasi Pembayaran</h2>

    <div>
        <strong>Nomor Pendaftaran:</strong> {{ $payment->student->nomor_pendaftaran }} <br>
        <strong>Nama:</strong> {{ $payment->student->nama_lengkap }} <br>
        <strong>Jumlah Pembayaran:</strong> Rp. {{ number_format($payment->jumlah, 0, ',', '.') }} <br>
        <strong>Tanggal Pembayaran:</strong> {{ \Carbon\Carbon::parse($payment->tanggal_bayar)->format('d F Y') }} <br>
        <strong>Verifikasi :</strong> {{ $payment->verifikasi == 0 ? 'Belum Lunas' : 'Lunas' }} <br>
    </div>

    <div class="mt-3">
        <h4>Bukti Pembayaran:</h4>
        @php
        $paymentUrl = route('admin.payments.show', [
            'studentId' => $payment->student_id,
            'filename'  => basename($payment->bukti_pembayaran),
        ]);
       @endphp
    
        <a href="{{ $paymentUrl }}" target="_blank">
            <img src="{{ $paymentUrl }}"
                alt="Bukti Pembayaran"
                width="300"
                class="mb-3"
                style="cursor: pointer;">
        </a>
    
    </div>

    <div class="mt-3">
        <label for="verifikasi">Status Verifikasi</label>
        <select wire:model="verifikasi" id="verifikasi" class="form-control">
            <option value="0" {{ $verifikasi == 0 ? 'selected' : '' }}>Menunggu Verifikasi</option>
            <option value="1" {{ $verifikasi == 1 ? 'selected' : '' }}>Terverifikasi</option>
        </select>
    </div>
    
    <button wire:click="updatePaymentStatus" class="btn btn-success mt-3">Update Status Pembayaran</button>
    
    @if (session()->has('message'))
        <div class="alert alert-success mt-3">{{ session('message') }}</div>
    @endif
</div>
