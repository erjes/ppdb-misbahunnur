<div>
    <h2>Detail Pendaftaran Siswa</h2>

    <h3>Data Siswa</h3>
    <table border="1" cellpadding="10">
        <tr>
            <td><strong>Nama Lengkap</strong></td>
            <td>{{ $student->nama_lengkap }}</td>
        </tr>
        <tr>
            <td><strong>Nomor Pendaftaran</strong></td>
            <td>{{ $student->nomor_pendaftaran }}</td>
        </tr>
        <tr>
            <td><strong>Tempat, Tanggal Lahir</strong></td>
            <td>{{ $student->tempat_kelahiran }}, {{ \Carbon\Carbon::parse($student->tanggal_lahir)->format('d F Y') }}</td>
        </tr>
        <tr>
            <td><strong>Jenis Kelamin</strong></td>
            <td>{{ $student->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}</td>
        </tr>
        <tr>
            <td><strong>Jalur Daftar</strong></td>
            <td>{{ $student->registration->jalur_daftar }}</td>
        </tr>
        <tr>
            <td><strong>Jenjang Daftar</strong></td>
            <td>{{ $student->registration->jenjang_daftar }}</td>
        </tr>
    </table>

    <h3>Status Pendaftaran</h3>
    <table border="1" cellpadding="10">
        <tr>
            <td><strong>Status</strong></td>
            <td>{{ $registration->status ?? 'Tidak ada status' }}</td>
        </tr>
        <tr>
            <td><strong>Tanggal Daftar</strong></td>
            <td>{{ \Carbon\Carbon::parse($registration->tanggal_daftar)->format('d F Y') }}</td>
        </tr>
    </table>

    <h3>Update Status Pendaftaran</h3>
    <form wire:submit.prevent="updateStatus">
        <select wire:model="newStatus" required>
            <option value="">Pilih Status</option>
            <option value="approved">Diterima</option>
            <option value="rejected">Ditolak</option>
            <option value="pending">Menunggu</option>
        </select>
        <button type="submit">Update Status</button>
    </form>

    <h3>Biaya Pendaftaran</h3>
    <table border="1" cellpadding="10">
        @foreach($fees as $fee)
            <tr>
                <td><strong>Biaya</strong></td>
                <td>{{ $fee->nama_biaya }}</td>
            </tr>
            <tr>
                <td><strong>Jumlah</strong></td>
                <td>{{ $fee->jumlah }}</td>
            </tr>
        @endforeach
    </table>

    <h3>Pembayaran</h3>
    @if($payments->isNotEmpty())
        <table border="1" cellpadding="10">
            @foreach($payments as $payment)
                <tr>
                    <td><strong>Jumlah Pembayaran</strong></td>
                    <td>{{ $payment->jumlah }}</td>
                </tr>
                <tr>
                    <td><strong>Tanggal Pembayaran</strong></td>
                    <td>{{ \Carbon\Carbon::parse($payment->tanggal_bayar)->format('d F Y') }}</td>
                </tr>
                <tr>
                    <td><strong>Status Verifikasi</strong></td>
                    <td>{{ $payment->verifikasi ? 'Terverifikasi' : 'Belum Terverifikasi' }}</td>
                </tr>
            @endforeach
        </table>
    @else
        <p>Belum ada pembayaran.</p>
    @endif
</div>
