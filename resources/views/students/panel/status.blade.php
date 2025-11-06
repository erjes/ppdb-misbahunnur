<x-app-layout>
    <h1>Halaman Status Pendaftaran</h1>


    <h2>Selamat Datang ({{ Auth::user()->name }}) di Sistem PPBD Mishbahunnur Cimahi</h2>
    <h3>Silahkan lengkapi dokumen</h3>

    <a href="{{ route('registration.documents') }}">Upload Dokumen</a>

    <div>
        
    </div>
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>No Pendaftaran</th>
                <th>NISN</th>
                <th>Nama Lengkap</th>
                <th>Status</th>
                <th>Kelulusan</th>
            </tr>
        </thead>
        <tbody>
                <tr>
                    <td>{{ $registration->student_id }}</td>
                    <td>{{ $student->nomor_pendaftaran ?? '-' }}</td>
                    <td>{{ $student->nisn ?? '-' }}</td>
                    <td>{{ $student->nama_lengkap ?? '-' }}</td>
                    <td>{{ $registration->status ?? '-' }}</td>
                    <td>
                        @if($registration->status != 'pending')
                            {{ $registration->is_confirmed ? 'Lulus' : 'Belum Lulus' }}
                        @else
                            -
                        @endif
                    </td>
                </tr>
        
                {{-- <tr>
                    <td colspan="6" style="text-align: center;">Belum ada data pendaftaran</td>
                </tr> --}}
            </tbody>
        </table>
    
</x-app-layout>