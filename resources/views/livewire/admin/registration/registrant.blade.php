<div>
    <table border="1" cellspacing="0" cellpadding="10">
        <thead>
            <tr>
                <th>No</th>
                <th>Nomor Pendaftaran</th>
                <th>Nama Lengkap</th>
                <th>Jenis Kelamin</th>
                <th>Status Pendaftaran</th>
                <th>Jenjang Pendaftaran</th>
                <th>Jalur Pendaftaran</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $index => $student)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $student->nomor_pendaftaran }}</td>
                    <td>{{ $student->nama_lengkap }}</td>
                    <td>{{ $student->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}</td>
                    <td>{{ $student->registration->status ?? 'Pending' }}</td>
                    <td>{{ $student->registration->jenjang_daftar ?? 'Pending' }}</td>
                    <td>{{ $student->registration->jalur_daftar ?? 'Pending' }}</td>
                    <td>
                        <a href="{{ route('admin.registrations.status', $student->nomor_pendaftaran) }}">Detail</a>
                        <a href="{{ route('admin.registrations.documents', $student->nomor_pendaftaran) }}">Dokumen</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
