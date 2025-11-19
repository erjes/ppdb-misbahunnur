<div>
    @if ($registration)
        <h3>Detail Pendaftaran</h3>
        
        <h4>Data Calon Santri</h4>
        <p><strong>Nama Lengkap:</strong> {{ $student->nama_lengkap }}</p>
        <p><strong>Nomor Pendaftaran:</strong> {{ $student->nomor_pendaftaran }}</p>
        <p><strong>Tempat Lahir:</strong> {{ $student->tempat_kelahiran }}</p>
        <p><strong>Tanggal Lahir:</strong> {{ \Carbon\Carbon::parse($student->tanggal_lahir)->format('d-m-Y') }}</p>
        <p><strong>Agama:</strong> {{ $student->agama }}</p>
        <p><strong>Jenis Kelamin:</strong> {{ $student->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
    
        <h4>Data Alamat</h4>
        <p><strong>Alamat Lengkap:</strong> {{ $addressData['alamat_lengkap'] ?? 'Tidak tersedia' }}</p>
        <p><strong>Provinsi:</strong> {{ $addressData['provinsi'] ?? 'Tidak tersedia' }}</p>
    
        <h4>Data Orang Tua</h4>
        <p><strong>Nama Ayah:</strong> {{ $parentData['ayah']['nama_lengkap'] ?? 'Tidak tersedia' }}</p>
        <p><strong>Nama Ibu:</strong> {{ $parentData['ibu']['nama_lengkap'] ?? 'Tidak tersedia' }}</p>
    
        <h4>Data Sekolah</h4>
        <p><strong>Nama Sekolah:</strong> {{ $schoolData['nama'] ?? 'Tidak tersedia' }}</p>
        <p><strong>NPSN:</strong> {{ $schoolData['npsn'] ?? 'Tidak tersedia' }}</p>
        <p><strong>Jenjang:</strong> {{ $schoolData['jenjang'] ?? 'Tidak tersedia' }}</p>
    
        <h4>Status Pendaftaran</h4>
        <p><strong>Status:</strong> {{ ucfirst($registration->status) }}</p>
        @if ($registration->is_paid != 1)
        <a href="{{ route('registration.payment.upload', ['studentId' => $student->id]) }}" target="_blank">Bayar</a>
        @endif
        
        <br>
        
        @if ($registration->status == 'rejected')
            {{-- <p><strong>Catatan:</strong> {{ $registration->catatan }}</p> --}}
        @endif
    
        @if ($registration && $registration->status == 'approved')
            <button wire:click="exportApprovedRegistration">Cetak Surat</button>
        @endif  
    
    @else
        <p>Data pendaftaran tidak ditemukan.</p>
    @endif
    </div>
    