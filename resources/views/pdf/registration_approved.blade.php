<!DOCTYPE html>
<html lang="id">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta charset="UTF-8">
    <title>Surat Pengumuman PPDB</title>
    <style>
        @font-face {
            font-family: 'DejaVu Sans';
            font-style: normal;
            font-weight: normal;
            src: url('{{ storage_path('fonts/DejaVuSans.ttf') }}') format('truetype');
        }
        @font-face {
            font-family: 'DejaVu Sans';
            font-style: normal;
            font-weight: bold;
            src: url('{{ storage_path('fonts/DejaVuSans-Bold.ttf') }}') format('truetype');
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 30px;
            font-size: 12px;
            color: #000;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            position: relative;
        }

        .header-with-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
        }

        .logo {
            width: 80px;
            height: 80px;
            margin-right: 10px;
        }

        .header-text {
            text-align: center;
            flex-grow: 1;
        }

        .header h1 {
            font-size: 16px;
            margin: 5px 0;
            font-weight: bold;
        }

        .header h2 {
            font-size: 14px;
            margin: 5px 0;
            font-weight: bold;
        }

        .header h3 {
            font-size: 12px;
            margin: 5px 0;
            font-weight: bold;
        }

        .header p {
            font-size: 11px;
            margin: 3px 0;
        }

        .divider {
            border-top: 1px solid #000;
            margin: 15px 0;
        }

        .announcement-title {
            text-align: center;
            font-weight: bold;
            margin: 15px 0;
            font-size: 14px;
        }

        .announcement-number {
            text-align: center;
            margin-bottom: 20px;
            font-size: 12px;
        }

        .student-data {
            width: 100%;
            margin: 20px 0;
        }

        .student-data table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }

        .student-data td {
            padding: 2x;
            vertical-align: top;
        }

        .student-data td:first-child {
            width: 35%;
            white-space: nowrap;
        }

        .result {
            text-align: center;
            font-weight: bold;
            font-size: 16px;
            margin: 25px 0;
            text-decoration: underline;
        }

        .verification-text {
            text-align: justify;
            margin: 20px 0;
            line-height: 1.6;
            font-size: 12px;
        }

        .signature {
            text-align: right;
            margin-top: 50px;
        }

        .signature p {
            margin: 5px 0;
        }

        .notes {
            margin-top: 30px;
            font-size: 12px;
        }

        .notes ol {
            margin: 5px 0;
            padding-left: 20px;
        }

        .notes li {
            margin-bottom: 5px;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-style: italic;
            font-size: 10px;
        }

        .bold {
            font-weight: bold;
        }

        .underline {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <!-- Header with Logo -->
    <div class="header">
        <div class="header-with-logo">
            <img src="{{ public_path('images/logo.png') }}" class="logo" alt="Logo">
            <div class="header-text">
                <h1>PANITIA SPMB</h1>
                <h2>PPTO MISBAHUNNUR CIMAHI</h2>
                <h3>TAHUN PELAJARAN 2025-2026</h3>
            </div>
        </div>
        <p><strong>Kantor : Jl. Kolonel Masturi No. 139 Cipangeran Kec Cimahi Utara, Cimahi 40511</strong></p>
        <p><strong>Website : misbahunnur.pompes.id - E-mail : humasmisbahunnur@gmail.com</strong></p>
    </div>

    <div class="divider"></div>

    <!-- Announcement Title -->
    <div class="announcement-title">
        S U R A T &nbsp; P E N G U M U M A N
    </div>
    <div class="announcement-number">
        {{-- No : 1111/11/M/11.11 --}}
    </div>

    <!-- Content -->
    <p>
        <strong>Kepala PPTO MISBAHUNNUR CIMAHI dengan ini menyatakan bahwa :</strong>
    </p>

    <!-- Student Data -->
    <div class="student-data">
        <table>
            <tr>
                <td>NO. PENDAFTARAN</td>
                <td>: {{ $student->nomor_pendaftaran ?? 'Data tidak tersedia' }}</td>
            </tr>
            <tr>
                <td>NISM</td>
                <td>: {{ $student->nism ?? 'Data tidak tersedia' }}</td>
            </tr>
            <tr>
                <td>NIK</td>
                <td>: {{ $student->nik ?? 'Data tidak tersedia' }}</td>
            </tr>
            <tr>
                <td>NAMA LENGKAP</td>
                <td>: {{ $student->nama_lengkap ?? 'Data tidak tersedia' }}</td>
            </tr>
            <tr>
                <td>JENIS KELAMIN</td>
                <td>: 
                    @if(isset($student->jenis_kelamin))
                        {{ $student->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}
                    @else
                        Data tidak tersedia
                    @endif
                </td>
            </tr>
            <tr>
                <td>TEMPAT, TANGGAL LAHIR</td>
                <td>: 
                    @if(isset($student->tempat_kelahiran) && isset($student->tanggal_lahir))
                        {{ $student->tempat_kelahiran }}, {{ \Carbon\Carbon::parse($student->tanggal_lahir)->format('d F Y') }}
                    @elseif(isset($student->tempat_kelahiran))
                        {{ $student->tempat_kelahiran }}, Data tidak tersedia
                    @elseif(isset($student->tanggal_lahir))
                        Data tidak tersedia, {{ \Carbon\Carbon::parse($student->tanggal_lahir)->format('d F Y') }}
                    @else
                        Data tidak tersedia
                    @endif
                </td>
            </tr>
            <tr>
                <td>AGAMA</td>
                <td>: {{ $student->agama ?? 'Data tidak tersedia' }}</td>
            </tr>
            <tr>
                <td>NAMA ORANG TUA /WALI</td>
                <td>:</td>
            </tr>
            <tr>
                <td>AYAH</td>
                <td>: {{ $parentData['ayah']['nama_lengkap'] ?? 'Data tidak tersedia' }}</td>
            </tr>
            <tr>
                <td>IBU</td>
                <td>: {{ $parentData['ibu']['nama_lengkap'] ?? 'Data tidak tersedia' }}</td>
            </tr>
            <tr>
                <td>ASAL SEKOLAH</td>
                <td>: {{ $schoolData['nama'] ?? 'Data tidak tersedia' }}</td>
            </tr>
        </table>
    </div>

    <!-- Result -->
    <div class="result">
        L U L U S
    </div>

    <!-- Verification Text -->
    <div class="verification-text">
        VERIFIKASI dan SELEKSI Sebagai Calon Peserta Didik PPTO MISBAHUNNUR CIMAHI tahun ajaran 2025/2026.
        Demikian pengumuman ini disampaikan untuk dapat digunakan sebagai mestinya.
    </div>

    <!-- Signature -->
    <div class="signature">
        <p>Cimahi, {{ \Carbon\Carbon::now()->format('d F Y') }}</p>
        <p>Kepala Panitia</p>
        <br><br><br>
        <p class="bold"></p>
        <p>NIP</p>
    </div>

    <!-- Notes -->
    <div class="notes">
        <p><strong>Keterangan :</strong></p>
        <ol>
            <li>Registrasi daftar ulang dilaksanakan pada tanggal 8 – 11 Juli 2021 pukul 08.00 – 14.00.</li>
            <li>Mencetak dan membawa Surat Pengumuman ini sebagai bukti lulus seleksi.</li>
            <li>Membawa materi Rp. 6000,- sebanyak 2 lembar.</li>
        </ol>
    </div>

    <!-- Footer -->
    <div class="footer">
        http://misbahunnur.pompes.id/japan/, www.misbahunnur.com
    </div>
</body>
</html>
