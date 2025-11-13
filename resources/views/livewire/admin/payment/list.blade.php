<div>
    <h2>Daftar Pembayaran</h2>
    
    <input type="text" wire:model="search" placeholder="Cari berdasarkan Nomor Pendaftaran, NISN, atau Nama" class="form-control mb-3">

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No. Pendaftaran</th>
                <th>Nama</th>
                <th>Bukti Pembayaran</th>
                <th>Status Pembayaran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($payments as $payment)
                <tr>
                    <td>{{ $payment->student->nomor_pendaftaran }}</td>
                    <td>{{ $payment->student->nama_lengkap }}</td>
                    <td><a href="{{ asset('storage/payments/' . $payment->file_path) }}" target="_blank">Lihat Bukti</a></td>
                    <td>{{ $payment->is_paid ? 'Terverifikasi' : 'Belum Terverifikasi' }}</td>
                    <td>
                        <a href="{{ route('admin.payments.verify', $payment->id) }}" class="btn btn-primary">Verifikasi</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data pembayaran.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $payments->links() }}
</div>
