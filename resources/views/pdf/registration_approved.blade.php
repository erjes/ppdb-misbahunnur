<!DOCTYPE html>
<html>

<head>
    <title>Surat Keputusan PPDB</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            line-height: 1.3;
            margin: 0;
            /* Reset margin agar tidak terpotong */
        }

        /* Utility Classes */
        .text-center {
            text-align: center;
        }

        .text-justify {
            text-align: justify;
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

        .mb-10 {
            margin-bottom: 10px;
        }

        .mt-20 {
            margin-top: 20px;
        }

        .page-break {
            page-break-before: always;
        }

        /* Header / Kop Surat */
        .header {
            text-align: center;
            border-bottom: 3px double black;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .header h1,
        .header h2,
        .header h3 {
            margin: 0;
            text-transform: uppercase;
        }

        .header h2 {
            font-size: 16pt;
            font-weight: bold;
        }

        .header h3 {
            font-size: 12pt;
            font-weight: normal;
        }

        .header p {
            margin: 0;
            font-size: 10pt;
            font-style: italic;
        }

        /* Judul Surat */
        .content-title {
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .content-title .main-title {
            font-size: 14pt;
            text-decoration: underline;
            display: block;
        }

        /* Tabel Layout (Menimbang, Mengingat, dll) */
        .section-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        .section-table td {
            vertical-align: top;
            padding: 2px;
        }

        .label-col {
            width: 130px;
            font-weight: bold;
        }

        .colon-col {
            width: 20px;
            text-align: center;
        }

        /* Lists */
        ol {
            margin: 0;
            padding-left: 20px;
        }

        li {
            padding-left: 5px;
            text-align: justify;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        /* Footer & Tanda Tangan */
        .footer-container {
            margin-top: 30px;
            width: 100%;
        }

        .ttd-container {
            float: right;
            width: 280px;
            /* Lebar area tanda tangan */
            text-align: left;
        }

        .ttd-image-box {
            position: relative;
            height: 100px;
            margin: 10px 0;
        }

        .ttd-img {
            position: absolute;
            top: 10px;
            left: 20px;
            height: 80px;
            z-index: 2;
        }

        .stempel-img {
            position: absolute;
            top: 0px;
            left: -30px;
            /* Geser kiri agar menimpa sedikit */
            height: 100px;
            z-index: 1;
            opacity: 0.85;
        }

        .signer-name {
            font-weight: bold;
            text-decoration: underline;
        }

        /* Clearfix untuk float */
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }
    </style>
</head>

<body>

    {{-- ================= HALAMAN 1: SURAT KEPUTUSAN ================= --}}

    <div class="header">
        <h2>Misbahunnur</h2>
        <h3>PONDOK PESANTREN TAHFIZH AL-QUR'AN</h3>
        <p>Jl. Kolonel Masturi KM. 03 Cipageran Kota Cimahi Tlp. 022 6632377</p>
    </div>

    <div class="content-title">
        <span class="main-title">SURAT KEPUTUSAN PANITIA PENERIMAAN PESERTA DIDIK BARU</span>
        <div>PPTQ MISBAHUNNUR</div>
        <div>TAHUN PELAJARAN {{ $school_year }}</div>
        <div class="mt-20">NO. {{ $sk_number }}</div>
        <div class="mt-20">TENTANG HASIL TES PPDB PPTQ MISBAHUNNUR</div>
        <div>GELOMBANG 1</div>
        <div>TINGKAT MTS DAN MA</div>
    </div>

    <div class="mt-20">
        <div class="text-center mb-10 text-bold">Ketua Panitia PPDB PPTQ Misbahunnur</div>

        {{-- Menimbang --}}
        <table class="section-table">
            <tr>
                <td class="label-col">Menimbang</td>
                <td class="colon-col">:</td>
                <td>
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
                <td class="label-col">Memperhatikan</td>
                <td class="colon-col">:</td>
                <td>
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
                <td class="label-col">Menetapkan</td>
                <td class="colon-col">:</td>
                <td></td>
            </tr>
            <tr>
                <td class="label-col">Pertama</td>
                <td class="colon-col">:</td>
                <td class="text-justify">
                    Bahwa Calon Santri atas nama <strong>{{ strtoupper($student->nama_lengkap) }}</strong> dinyatakan
                    <strong style="font-size: 14pt;">LULUS</strong>.
                </td>
            </tr>
            <tr>
                <td class="label-col">Kedua</td>
                <td class="colon-col">:</td>
                <td class="text-justify">
                    Surat keputusan ini disampaikan kepada orang tua yang bersangkutan untuk diketahui.
                </td>
            </tr>
            <tr>
                <td class="label-col">Ketiga</td>
                <td class="colon-col">:</td>
                <td class="text-justify">
                    Surat keputusan ini berlaku sejak tanggal ditetapkan dan apabila dikemudian hari ternyata terdapat
                    kekeliruan dalam penetapan ini maka akan diperbaharui seperlunya.
                </td>
            </tr>
        </table>
    </div>

    {{-- Tanda Tangan Halaman 1 --}}
    <div class="footer-container clearfix">
        <div class="ttd-container">
            <div>Ditetapkan di: {{ $city }}</div>
            <div>Pada Tanggal: {{ $date }}</div>
            <br>
            <div class="text-bold">{{ $signer_title }}</div>

            <div class="ttd-image-box">
                @if($stamp)
                    <img src="{{ $stamp }}" class="stempel-img" alt="Stempel">
                @endif
                @if($signature)
                    <img src="{{ $signature }}" class="ttd-img" alt="TTD">
                @endif
            </div>

            <div class="signer-name">{{ $signer_name }}</div>
        </div>
    </div>

    {{-- ================= HALAMAN 2: PEMBERITAHUAN ================= --}}
    <div class="page-break"></div>

    <div class="header">
        <h2>Misbahunnur</h2>
        <h3>PONDOK PESANTREN TAHFIZH AL-QUR'AN</h3>
        <p>Jl. Kolonel Masturi KM. 03 Cipageran Kota Cimahi Tlp. 022 6632377</p>
    </div>

    <div class="text-center mb-10">
        <h3 class="text-bold underline">PEMBERITAHUAN</h3>
    </div>

    <div class="text-justify">
        <p>Diberitahukan kepada seluruh orang tua calon santri Pondok Pesantren Tahfizh Al-Qur'an (PPTQ) Misbahunnur
            Tahun Pelajaran {{ $school_year }} bahwa:</p>

        <p>Calon Santri PPTQ Misbahunnur TP. {{ $school_year }} yang telah dinyatakan lulus dalam tes Gelombang I bisa
            diterima sebagai santri PPTQ Misbahunnur TP. {{ $school_year }} secara resmi apabila:</p>

        <ol>
            <li class="mb-10">
                Melengkapi data/persyaratan pendaftaran Bagi yang belum diserahkan (Fotocopy KTP orangtua, Akta
                Kelahiran, Kartu Keluarga, dan Kartu NISN. Sementara untuk fotocopi Ijazah dan SKHUS bisa menyusul);
            </li>
            <li>
                Menyelesaikan Administrasi Dana Sumbangan Pembangunan (DSP) dengan ketentuan:
                <ol type="a" style="margin-top: 5px;">
                    <li>Pembayaran DSP dibayarkan minimal 50% dari total DSP yang wajib dibayarkan.</li>
                    <li>Waktu pembayaran mulai tanggal <strong>{{ $payment_deadline_1_start }}</strong> sampai
                        <strong>{{ $payment_deadline_1_end }}</strong> sebagai pembayaran tahap I;
                    </li>
                    <li>Administrasi DSP secara keseluruhan harus lunas tanggal
                        <strong>{{ $payment_deadline_1_end }}</strong> (hari berikutnya) sampai
                        <strong>{{ $payment_deadline_2_end }}</strong> sebagai pembayaran tahap II;
                    </li>
                    <li>Untuk Kedatangan Santri akan kami beritahukan pada pengumuman selanjutnya di group gelombang 1.
                    </li>
                </ol>
            </li>
        </ol>

        <p class="text-bold mt-20">Berikut adalah hal-hal yang berkaitan dengan pengunduran diri:</p>
        <ol>
            <li>Calon santri yang belum ada pembayaran tahap I sampai {{ $payment_deadline_1_end }} dinyatakan
                mengundurkan diri;</li>
            <li>Bagi calon santri yang langsung melunasi DSP ada potongan 15% dari Uang Pembangunan.</li>
            <li>Calon santri yang mengundurkan diri sebelum tahun Pelajaran {{ $school_year }} dimulai, maka uang DSP
                dikembalikan sebesar 100% dari yang telah dibayarkan;</li>
            <li>Santri yang mengundurkan diri setelah dimulainya kegiatan tidak ada pengembalian uang DSP.</li>
            <li>Santri yang dikeluarkan (karena melanggar aturan pesantren) setelah dimulainya kegiatan tidak ada
                pengembalian uang DSP.</li>
        </ol>

        <p>Demikian surat pemberitahuan ini kami sampaikan. Atas perhatian dan kerjasamanya kami haturkan terima kasih.
            Teriring Jazakumullah khairan katsiiran.</p>
    </div>

    {{-- Tanda Tangan Halaman 2 --}}
    <div class="footer-container clearfix">
        <div class="ttd-container">
            <div>{{ $city }}, {{ $date }}</div>
            <div class="text-bold">{{ $signer_title }}</div>

            <div class="ttd-image-box">
                @if($stamp)
                    <img src="{{ $stamp }}" class="stempel-img" alt="Stempel">
                @endif
                @if($signature)
                    <img src="{{ $signature }}" class="ttd-img" alt="TTD">
                @endif
            </div>

            <div class="signer-name">{{ $signer_name }}</div>
        </div>
    </div>

    {{-- Note Footer --}}
    <div style="clear: both; margin-top: 20px; border-top: 1px solid black; padding-top: 10px; font-size: 10pt;">
        <strong>Nb.</strong> Pembayaran DSP bisa langsung ke Kantor PPTQ Misbahunnur atau melalui
        {{ $bank_account_info }} dengan menyertakan nama orang tua dan nama calon santri dan memberikan informasinya ke
        bagian keuangan PPTQ Misbahunnur.
        <br>
        Hub. WA 0812 8484 8495 (Admin Keuangan)
    </div>

</body>

</html>