<div class="max-w-5xl mx-auto space-y-6 pb-12">

    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200">
        <div class="bg-gradient-to-r from-green-600 to-green-700 px-6 py-4 flex justify-between items-center">
            <h2 class="text-xl font-bold text-white flex items-center">
                <i class="fa-solid fa-id-card mr-3"></i>
                Detail Pendaftaran Siswa
            </h2>
            <span class="bg-white/20 text-white px-3 py-1 rounded-full text-sm font-semibold backdrop-blur-sm">
                {{ $student->nomor_pendaftaran ?? '-' }}
            </span>
        </div>

        <div class="p-6">
            {{-- DATA UTAMA (HEADER INFO) --}}
            <div class="flex flex-col md:flex-row gap-6 mb-8 items-start">
                <div class="w-full md:w-auto flex justify-center">
                    <div
                        class="w-32 h-32 bg-gray-100 rounded-full flex items-center justify-center border-4 border-green-50 shadow-sm">
                        <i class="fa-solid fa-user text-5xl text-gray-300"></i>
                    </div>
                </div>
                <div class="flex-1 w-full grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Nama Lengkap</p>
                        <p class="text-xl font-bold text-gray-800">{{ $student->nama_lengkap }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-medium">NISN</p>
                        <p class="text-lg font-semibold text-gray-700 font-mono">{{ $student->nisn }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Jalur & Gelombang</p>
                        <p class="text-gray-800 font-medium">
                            <span class="text-green-600 font-bold">{{ $student->jalur_daftar }}</span>
                            (Gelombang {{ $student->registration->gelombang }})
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Jenjang & Jenis</p>
                        <p class="text-gray-800 font-medium">{{ $student->registration->jenjang_daftar }} -
                            {{ $student->registration->jalur_daftar }}
                        </p>
                    </div>
                </div>
            </div>

            <hr class="border-gray-100 my-6">

            {{-- 1. DATA PRIBADI --}}
            <div class="mb-8">
                <h3 class="text-lg font-bold text-green-700 mb-4 flex items-center">
                    <i class="fa-solid fa-user-pen mr-2"></i> Data Pribadi
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 bg-gray-50 p-6 rounded-xl border border-gray-100">
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold">NIK Siswa</p>
                        <p class="font-medium text-gray-800">{{ $student->nik_siswa }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold">Jenis Kelamin</p>
                        <p class="font-medium text-gray-800">
                            {{ $student->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}
                        </p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold">Tempat, Tanggal Lahir
                        </p>
                        <p class="font-medium text-gray-800">
                            {{ $student->tempat_kelahiran }},
                            {{ \Carbon\Carbon::parse($student->tanggal_lahir)->translatedFormat('d F Y') }}
                        </p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold">Agama</p>
                        <p class="font-medium text-gray-800">{{ $student->agama }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold">Nomor HP</p>
                        <p class="font-medium text-gray-800">{{ $student->no_hp }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold">Hobi / Cita-cita</p>
                        <p class="font-medium text-gray-800">{{ $student->hobi }} / {{ $student->cita_cita }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold">Anak Ke / Jml Saudara
                        </p>
                        <p class="font-medium text-gray-800">{{ $student->anak_ke }} dari {{ $student->jumlah_saudara }}
                            Bersaudara</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold">Status Dalam Keluarga
                        </p>
                        <p class="font-medium text-gray-800">{{ $student->status_keluarga }}</p>
                    </div>
                </div>
            </div>

            {{-- 2. DATA PENDIDIKAN SEBELUMNYA --}}
            <div class="mb-8">
                <h3 class="text-lg font-bold text-green-700 mb-4 flex items-center">
                    <i class="fa-solid fa-school mr-2"></i> Data Sekolah Asal
                </h3>
                <div
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 bg-gray-50 p-6 rounded-xl border border-gray-100">
                    <div class="md:col-span-2">
                        <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold">Nama Sekolah Asal</p>
                        <p class="font-medium text-gray-800">{{ $student->nama_sekolah }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold">NPSN</p>
                        <p class="font-medium text-gray-800">{{ $student->npsn_sekolah }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold">Status Sekolah</p>
                        <p class="font-medium text-gray-800">{{ $student->status_sekolah }}
                            ({{ $student->jenjang_sekolah }})</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold">Lokasi Sekolah</p>
                        <p class="font-medium text-gray-800">{{ $student->lokasi_sekolah }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold">Riwayat Pendidikan</p>
                        <div class="flex gap-2 mt-1">
                            <span
                                class="px-2 py-1 bg-white border rounded text-xs {{ $student->pernah_paud == 'Ya' ? 'text-green-600 border-green-200 bg-green-50' : 'text-gray-400' }}">PAUD:
                                {{ $student->pernah_paud }}</span>
                            <span
                                class="px-2 py-1 bg-white border rounded text-xs {{ $student->pernah_tk == 'Ya' ? 'text-green-600 border-green-200 bg-green-50' : 'text-gray-400' }}">TK:
                                {{ $student->pernah_tk }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 3. ALAMAT & TEMPAT TINGGAL --}}
            <div class="mb-8">
                <h3 class="text-lg font-bold text-green-700 mb-4 flex items-center">
                    <i class="fa-solid fa-map-location-dot mr-2"></i> Alamat & Tempat Tinggal
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-gray-50 p-6 rounded-xl border border-gray-100">
                    <div class="md:col-span-2">
                        <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold">Alamat Lengkap</p>
                        <p class="font-medium text-gray-800">{{ $student->alamat }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold">Desa / Kelurahan</p>
                        <p class="font-medium text-gray-800">{{ $student->desa }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold">Kecamatan</p>
                        <p class="font-medium text-gray-800">{{ $student->kecamatan }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold">Kabupaten / Kota</p>
                        <p class="font-medium text-gray-800">{{ $student->kabupaten }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold">Provinsi</p>
                        <p class="font-medium text-gray-800">{{ $student->provinsi }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold">Kode Pos</p>
                        <p class="font-medium text-gray-800">{{ $student->kode_pos }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold">Jarak ke Sekolah</p>
                        <p class="font-medium text-gray-800">{{ $student->jarak_ke_sekolah }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold">Transportasi</p>
                        <p class="font-medium text-gray-800">{{ $student->transportasi }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold">Rencana Tempat Tinggal
                        </p>
                        <span
                            class="inline-block mt-1 px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm font-semibold">
                            {{ $student->jenis_tempat_tinggal }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- 4. DATA ORANG TUA / WALI --}}
            <div class="mb-8">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4">
                    <h3 class="text-lg font-bold text-green-700 flex items-center">
                        <i class="fa-solid fa-users mr-2"></i> Data Keluarga
                    </h3>
                    <div class="text-sm bg-gray-100 px-3 py-1 rounded text-gray-600 mt-2 md:mt-0">
                        <span class="font-bold">No. KK:</span> {{ $student->no_kk }} |
                        <span class="font-bold">Kepala Keluarga:</span> {{ $student->nama_kepala_keluarga }}
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    {{-- AYAH --}}
                    <div class="bg-blue-50 p-5 rounded-xl border border-blue-100">
                        <h4 class="font-bold text-blue-800 border-b border-blue-200 pb-2 mb-3">
                            <i class="fa-solid fa-user-tie mr-1"></i> Data Ayah
                        </h4>
                        <div class="space-y-3">
                            <div>
                                <p class="text-xs text-gray-500">Nama Lengkap</p>
                                <p class="font-semibold text-gray-800">{{ $student->nama_ayah }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">NIK</p>
                                <p class="font-mono text-sm text-gray-700">{{ $student->nik_ayah }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Status Hidup</p>
                                <p class="font-medium text-gray-800">{{ $student->status_ayah }}</p>
                            </div>
                            <div class="grid grid-cols-2 gap-2">
                                <div>
                                    <p class="text-xs text-gray-500">Lahir</p>
                                    <p class="text-sm">{{ $student->tahun_lahir_ayah }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Pendidikan</p>
                                    <p class="text-sm">{{ $student->pendidikan_ayah }}</p>
                                </div>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Pekerjaan</p>
                                <p class="text-sm font-medium">{{ $student->pekerjaan_ayah }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Penghasilan</p>
                                <p class="text-sm font-medium">{{ $student->penghasilan_ayah }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- IBU --}}
                    <div class="bg-pink-50 p-5 rounded-xl border border-pink-100">
                        <h4 class="font-bold text-pink-800 border-b border-pink-200 pb-2 mb-3">
                            <i class="fa-solid fa-user-nurse mr-1"></i> Data Ibu
                        </h4>
                        <div class="space-y-3">
                            <div>
                                <p class="text-xs text-gray-500">Nama Lengkap</p>
                                <p class="font-semibold text-gray-800">{{ $student->nama_ibu }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">NIK</p>
                                <p class="font-mono text-sm text-gray-700">{{ $student->nik_ibu }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Status Hidup</p>
                                <p class="font-medium text-gray-800">{{ $student->status_ibu }}</p>
                            </div>
                            <div class="grid grid-cols-2 gap-2">
                                <div>
                                    <p class="text-xs text-gray-500">Lahir</p>
                                    <p class="text-sm">{{ $student->tahun_lahir_ibu }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Pendidikan</p>
                                    <p class="text-sm">{{ $student->pendidikan_ibu }}</p>
                                </div>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Pekerjaan</p>
                                <p class="text-sm font-medium">{{ $student->pekerjaan_ibu }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Penghasilan</p>
                                <p class="text-sm font-medium">{{ $student->penghasilan_ibu }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- WALI --}}
                    <div class="bg-gray-50 p-5 rounded-xl border border-gray-200">
                        <h4 class="font-bold text-gray-700 border-b border-gray-200 pb-2 mb-3">
                            <i class="fa-solid fa-user-group mr-1"></i> Data Wali
                        </h4>
                        <div class="space-y-3">
                            <div>
                                <p class="text-xs text-gray-500">Nama Lengkap</p>
                                <p class="font-semibold text-gray-800">{{ $student->nama_wali }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">NIK</p>
                                <p class="font-mono text-sm text-gray-700">{{ $student->nik_wali }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">No. HP Wali</p>
                                <p class="font-medium text-gray-800">{{ $student->no_hp_wali }}</p>
                            </div>
                            <div class="grid grid-cols-2 gap-2">
                                <div>
                                    <p class="text-xs text-gray-500">Lahir</p>
                                    <p class="text-sm">{{ $student->tahun_lahir_wali }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Pendidikan</p>
                                    <p class="text-sm">{{ $student->pendidikan_wali }}</p>
                                </div>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Pekerjaan</p>
                                <p class="text-sm font-medium">{{ $student->pekerjaan_wali }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Penghasilan</p>
                                <p class="text-sm font-medium">{{ $student->penghasilan_wali }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 5. KESEJAHTERAAN & BANTUAN SOSIAL --}}
            <div class="mb-8">
                <h3 class="text-lg font-bold text-green-700 mb-4 flex items-center">
                    <i class="fa-solid fa-hand-holding-heart mr-2"></i> Kesejahteraan & Bantuan
                </h3>
                <div class="grid grid-cols-3 gap-4 bg-yellow-50 p-6 rounded-xl border border-yellow-100">
                    <div class="text-center p-3 bg-white rounded-lg shadow-sm">
                        <p class="text-xs text-gray-500 font-bold mb-1">No. KIP</p>
                        <p class="font-mono text-gray-800">{{ $student->kip }}</p>
                    </div>
                    <div class="text-center p-3 bg-white rounded-lg shadow-sm">
                        <p class="text-xs text-gray-500 font-bold mb-1">No. KKS</p>
                        <p class="font-mono text-gray-800">{{ $student->kks }}</p>
                    </div>
                    <div class="text-center p-3 bg-white rounded-lg shadow-sm">
                        <p class="text-xs text-gray-500 font-bold mb-1">No. PKH</p>
                        <p class="font-mono text-gray-800">{{ $student->pkh }}</p>
                    </div>
                </div>
            </div>

            {{-- 6. STATUS & RIWAYAT PEMBAYARAN --}}
            <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200">
                <div class="bg-gradient-to-r from-green-600 to-green-700 px-6 py-4">
                    <h3 class="text-xl font-bold text-white flex items-center">
                        <i class="fa-solid fa-money-bill-wave mr-3"></i>
                        Riwayat & Bukti Pembayaran
                    </h3>
                </div>

                <div class="p-6 space-y-8">

                    {{-- BAGIAN 1: TABEL RIWAYAT --}}
                    <div>
                        <h4 class="text-lg font-bold text-gray-700 mb-4 flex items-center">
                            <i class="fa-solid fa-list-ul mr-2 text-green-600"></i>
                            Rincian Transaksi
                        </h4>

                        @if($payments->isNotEmpty())
                            <div class="overflow-x-auto rounded-xl border border-gray-200 shadow-sm">
                                <table class="w-full text-sm text-left">
                                    <thead class="bg-gray-50 text-gray-700 uppercase font-bold text-xs">
                                        <tr>
                                            <th class="px-6 py-3">No</th>
                                            <th class="px-6 py-3">Jumlah</th>
                                            <th class="px-6 py-3">Tanggal Bayar</th>
                                            <th class="px-6 py-3">Status Verifikasi</th>
                                            <th class="px-6 py-3 text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 bg-white">
                                        @foreach($payments as $index => $payment)
                                            <tr class="hover:bg-gray-50 transition-colors">
                                                <td class="px-6 py-4 text-gray-500 font-medium">{{ $index + 1 }}</td>
                                                <td class="px-6 py-4 font-bold text-green-700">
                                                    Rp {{ number_format($payment->jumlah, 0, ',', '.') }}
                                                </td>
                                                <td class="px-6 py-4 text-gray-600">
                                                    {{ \Carbon\Carbon::parse($payment->tanggal_bayar)->translatedFormat('d F Y') }}
                                                </td>
                                                <td class="px-6 py-4">
                                                    @if($payment->verifikasi)
                                                        <span
                                                            class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold inline-flex items-center shadow-sm">
                                                            <i class="fa-solid fa-check-circle mr-1"></i> Terverifikasi
                                                        </span>
                                                    @else
                                                        <span
                                                            class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-bold inline-flex items-center shadow-sm">
                                                            <i class="fa-solid fa-clock mr-1"></i> Menunggu
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 text-center">
                                                    @if($payment->bukti_pembayaran)
                                                        <a href="{{ route('admin.payments.show', ['studentId' => $studentId, 'filename' => basename($payment->bukti_pembayaran)]) }}"
                                                            target="_blank"
                                                            class="text-blue-600 hover:text-blue-800 font-medium text-xs border border-blue-200 hover:bg-blue-50 px-3 py-1.5 rounded transition">
                                                            <i class="fa-solid fa-eye mr-1"></i> Lihat Bukti
                                                        </a>
                                                    @else
                                                        <span class="text-gray-400 text-xs">-</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="p-8 text-center bg-gray-50 rounded-xl border-2 border-dashed border-gray-300">
                                <i class="fa-solid fa-invoice text-gray-400 text-4xl mb-3"></i>
                                <p class="text-gray-500 font-medium">Belum ada data pembayaran yang terekam.</p>
                            </div>
                        @endif
                    </div>

                    {{-- BAGIAN 2: GALERI BUKTI (Hanya muncul jika ada pembayaran) --}}
                    @if($payments->isNotEmpty())
                        <div class="border-t border-gray-100 pt-6">
                            <h4 class="text-lg font-bold text-gray-700 mb-4 flex items-center">
                                <i class="fa-solid fa-images mr-2 text-purple-600"></i>
                                Lampiran Bukti Pembayaran
                            </h4>

                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                @foreach($payments as $payment)
                                    @if($payment->bukti_pembayaran)
                                        @php
                                            $paymentUrl = route('admin.payments.show', [
                                                'studentId' => $studentId,
                                                'filename' => basename($payment->bukti_pembayaran),
                                            ]);
                                        @endphp

                                        <div
                                            class="group relative bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-md transition-all overflow-hidden">
                                            <div
                                                class="px-4 py-2 bg-gray-50 border-b border-gray-100 flex justify-between items-center text-xs text-gray-500">
                                                <span>{{ \Carbon\Carbon::parse($payment->tanggal_bayar)->format('d/m/Y') }}</span>
                                                <span class="font-bold text-gray-700">Rp
                                                    {{ number_format($payment->jumlah, 0, ',', '.') }}</span>
                                            </div>

                                            <div class="relative h-48 w-full bg-gray-100 overflow-hidden">
                                                <img src="{{ $paymentUrl }}" alt="Bukti Bayar"
                                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">

                                                <div
                                                    class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center gap-2">
                                                    <a href="{{ $paymentUrl }}" target="_blank"
                                                        class="bg-white text-gray-800 p-2 rounded-full hover:bg-green-500 hover:text-white transition shadow-lg"
                                                        title="Lihat Penuh">
                                                        <i class="fa-solid fa-expand"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif

                </div>
            </div>

        </div>
    </div>
</div>