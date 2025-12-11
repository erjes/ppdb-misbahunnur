<!DOCTYPE html>
<html>

<head>
    <title>Surat Keputusan</title>
    <style>
        /* ================= SETTING HALAMAN & FONT ================= */
        @page {
            margin: 1cm 2cm 1cm 2cm;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 11pt;
            line-height: 1.05;
            color: #000;
        }

        .text-center {
            text-align: center;
        }

        .text-justify {
            text-align: justify;
        }

        .text-left {
            text-align: left;
        }

        .text-bold {
            font-weight: bold;
        }

        .uppercase {
            text-transform: uppercase;
        }

        .underline {
            text-decoration: underline;
        }

        .italic {
            font-style: italic;
        }

        .mb-10 {
            margin-bottom: 10px;
        }

        .mt-10 {
            margin-top: 10px;
        }

        .mt-20 {
            margin-top: 20px;
        }

        .page-break {
            page-break-before: always;
        }

        .header-wrapper {
            text-align: center;
            border-bottom: 3px double black;
            margin-bottom: 10px;
            padding-bottom: 10px;
        }

        .header-logo img {
            width: 70px;
            height: auto;
            margin-bottom: 10px;
        }

        .header-text h2 {
            font-size: 18pt;
            margin: 0;
            font-weight: bold;
            text-transform: capitalize;
        }

        .header-text h3 {
            font-size: 12pt;
            margin: 5px 0;
            font-weight: bold;
            text-transform: uppercase;
        }

        .header-text p {
            font-size: 10pt;
            margin: 0;
            font-style: italic;
        }

        /* ================= JUDUL SURAT ================= */
        .content-title {
            text-align: center;
            margin-bottom: 25px;
            font-weight: bold;
        }

        .content-title .main-title {
            font-size: 12pt;
            text-decoration: underline;
            text-transform: uppercase;
            display: block;
            margin-bottom: 2px;
        }

        .nomor-surat {
            font-size: 12pt;
            text-transform: uppercase;
            margin-top: 2px;
        }

        .tentang {
            margin-top: 15px;
            text-transform: uppercase;
        }

        /* ================= TABEL KONTEN (MENIMBANG DLL) ================= */
        .section-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        .section-table td {
            vertical-align: top;
            padding: 2px 0;
        }

        .col-label {
            width: 140px;
            font-weight: bold;
        }

        .col-colon {
            width: 20px;
            text-align: center;
        }

        .col-content {
            text-align: justify;
        }

        /* ================= LIST STYLES ================= */
        ol {
            margin: 0;
            padding-left: 20px;
        }

        ol li {
            padding-left: 5px;
            text-align: justify;
            margin-bottom: 3px;
        }

        ul {
            margin: 0;
            padding-left: 20px;
            list-style-type: disc;
        }

        /* ================= TANDA TANGAN (TTD) ================= */
        .footer-container {
            margin-top: 30px;
            width: 100%;
        }

        .ttd-box {
            width: 40%;
            float: right;
            text-align: left;
        }

        .ttd-image-container {
            position: relative;
            height: 100px;
            width: 100%;
            margin: 5px 0;
        }

        .img-stempel {
            position: absolute;
            top: 0px;
            left: -20px;
            height: 90px;
            z-index: 20;
            opacity: 0.85;
        }

        .img-ttd {
            position: absolute;
            top: 10px;
            left: 10px;
            height: 100px;
            z-index: 10;
        }

        .signer-name {
            font-weight: bold;
            text-decoration: underline;
        }

        /* ================= FOOTER NOTE ================= */
        .footer-note {
            margin-top: 40px;
            border-top: 1px solid black;
            padding-top: 5px;
            font-size: 9pt;
            font-style: italic;
        }
    </style>
</head>

<body>

    {{-- ================= HALAMAN 1 ================= --}}

    {{-- Header Baru: Logo di Atas Teks --}}
    <div class="header-wrapper">
        <div class="header-logo">
            <img src="{{ public_path('images/logo.png') }}" alt="Logo">
        </div>
        <div class="header-text">
            <h2>Misbahunnur</h2>
            <h3>PONDOK PESANTREN TAHFIZH AL-QUR'AN</h3>
            <p>Jl. Kolonel Masturi KM. 03 Cipageran Kota Cimahi Tlp. 022 6632377</p>
        </div>
    </div>

    {{-- Judul SK --}}
    <div class="content-title">
        <span class="main-title">SURAT KEPUTUSAN PANITIA PENERIMAAN PESERTA DIDIK BARU</span>
        <div class="main-title" style="text-decoration: none;">PPTQ MISBAHUNNUR</div>
        <div class="main-title" style="text-decoration: none;">TAHUN PELAJARAN {{ $school_year }}</div>

        <div class="nomor-surat">NO. {{ $sk_number }}</div>

        <div class="tentang">
            <div>TENTANG HASIL TES PPDB PPTQ MISBAHUNNUR</div>
            <div>GELOMBANG 1</div>
            <div>TINGKAT MTS DAN MA</div>
        </div>
    </div>

    {{-- Isi --}}
    <div class="mt-20">
        <div class="text-center mb-10 text-bold">Ketua Panitia PPDB PPTQ Misbahunnur</div>

        {{-- Menimbang --}}
        <table class="section-table">
            <tr>
                <td class="col-label">Menimbang</td>
                <td class="col-colon">:</td>
                <td class="col-content">
                    @if(count($menimbang) > 0)
                        <ol>
                            @foreach($menimbang as $item)
                                <li>{{ preg_replace('/^\d+\.\s*/', '', $item) }}</li>
                            @endforeach
                        </ol>
                    @endif
                </td>
            </tr>
        </table>

        {{-- Memperhatikan --}}
        <table class="section-table">
            <tr>
                <td class="col-label">Memperhatikan</td>
                <td class="col-colon">:</td>
                <td class="col-content">
                    @if(count($memperhatikan) > 0)
                        <ol>
                            @foreach($memperhatikan as $item)
                                <li>{{ preg_replace('/^\d+\.\s*/', '', $item) }}</li>
                            @endforeach
                        </ol>
                    @endif
                </td>
            </tr>
        </table>

        <div class="text-center text-bold" style="margin: 15px 0;">MEMUTUSKAN</div>

        {{-- Menetapkan --}}
        <table class="section-table">
            <tr>
                <td class="col-label">Menetapkan</td>
                <td class="col-colon">:</td>
                <td class="col-content"></td>
            </tr>
            <tr>
                <td class="col-label">Pertama</td>
                <td class="col-colon">:</td>
                <td class="col-content">
                    Bahwa Calon Santri atas nama <span class="text-bold uppercase">{{ $student->nama_lengkap }}</span>
                    dinyatakan
                    <span class="text-bold" style="font-size: 13pt;">LULUS</span>.
                </td>
            </tr>
            <tr>
                <td class="col-label">Kedua</td>
                <td class="col-colon">:</td>
                <td class="col-content">
                    Surat keputusan ini disampaikan kepada orang tua yang bersangkutan untuk diketahui.
                </td>
            </tr>
            <tr>
                <td class="col-label">Ketiga</td>
                <td class="col-colon">:</td>
                <td class="col-content">
                    Surat keputusan ini berlaku sejak tanggal ditetapkan dan apabila dikemudian hari ternyata terdapat
                    kekeliruan dalam penetapan ini maka akan diperbaharui seperlunya.
                </td>
            </tr>
        </table>
    </div>

    {{-- Tanda Tangan Halaman 1 --}}
    <div class="footer-container">
        <div class="ttd-box">
            <div>Ditetapkan di : {{ $city }}</div>
            <div>Pada Tanggal : {{ $date }}</div>
            <div class="text-bold mt-10">{{ $signer_title }}</div>

            <div class="ttd-image-container">
                @if($signature)
                    <img src="{{ $signature }}" class="img-ttd" alt="TTD">
                @endif

                @if($stamp)
                    <img src="{{ $stamp }}" class="img-stempel" alt="Stempel">
                @endif
            </div>

            <div class="signer-name">{{ $signer_name }}</div>
        </div>
        <div style="clear: both;"></div>
    </div>

    {{-- ================= HALAMAN 2 ================= --}}
    <div class="page-break"></div>

    {{-- Header Halaman 2 (Sama dengan Halaman 1) --}}
    <div class="header-wrapper">
        <div class="header-logo">
            <img src="{{ public_path('images/logo.png') }}" alt="Logo">
        </div>
        <div class="header-text">
            <h2>Misbahunnur</h2>
            <h3>PONDOK PESANTREN TAHFIZH AL-QUR'AN</h3>
            <p>Jl. Kolonel Masturi KM. 03 Cipageran Kota Cimahi Tlp. 022 6632377</p>
        </div>
    </div>

    <div class="text-center mb-1 mt-1">
        <h3 class="text-bold underline">PEMBERITAHUAN</h3>
    </div>

    <div class="text-justify">
        <p>{{ $p2_opening }}</p>
        <p>{{ $p2_conditional }}</p>

        <ol>
            {{-- Poin 1 --}}
            <li class="mb-10">
                @if(count($p2_requirements) > 1)
                    <ul style="padding-left: 15px;">
                        @foreach($p2_requirements as $req)
                            <li>{{ $req }}</li>
                        @endforeach
                    </ul>
                @else
                    {{ $p2_requirements[0] ?? '' }}
                @endif
            </li>

            {{-- Poin 2 (Ketentuan Pembayaran) --}}
            <li>
                Menyelesaikan Administrasi Dana Sumbangan Pembangunan (DSP) dengan ketentuan:
                <ol type="a" style="margin-top: 5px;">
                    @foreach($p2_payment_terms as $term)
                        <li>{{ $term }}</li>
                    @endforeach
                </ol>
            </li>
        </ol>

        <div class="text-bold mt-20 mb-10">{{ $p2_resign_intro }}</div>

        <ol>
            @foreach($p2_resign_points as $point)
                <li>{{ $point }}</li>
            @endforeach
        </ol>

        <p class="mt-20">{{ $p2_closing }}</p>
    </div>

    {{-- Tanda Tangan Halaman 2 --}}
    <div class="footer-container">
        <div class="ttd-box">
            <div>{{ $city }}, {{ $date }}</div>
            <div class="text-bold">{{ $signer_title }}</div>

            <div class="ttd-image-container">
                @if($signature)
                    <img src="{{ $signature }}" class="img-ttd" alt="TTD">
                @endif

                @if($stamp)
                    <img src="{{ $stamp }}" class="img-stempel" alt="Stempel">
                @endif
            </div>

            <div class="signer-name">{{ $signer_name }}</div>
        </div>
        <div style="clear: both;"></div>
    </div>

    {{-- Footer Note (Rekening dll) --}}
    <div class="footer-note">
        {!! $p2_footer_note !!}
    </div>

</body>

</html>