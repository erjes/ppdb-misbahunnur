<div class="p-4">
    <h1 class="text-lg font-semibold">Data Pendaftar MTS</h1>

    <div class="mt-3" style="display:flex; gap:.5rem; align-items:center;">
        <input type="text" placeholder="Cari nama/nomor/NISN/NIK"
               wire:model.debounce.400ms="search"
               style="padding:.5rem; border:1px solid #ddd; border-radius:.375rem; width:260px;">
        <select wire:model="perPage" style="padding:.4rem; border:1px solid #ddd; border-radius:.375rem;">
            <option value="10">10 / halaman</option>
            <option value="25">25 / halaman</option>
            <option value="50">50 / halaman</option>
            <option value="100">100 / halaman</option>
        </select>

        <a href="{{ route('admin.students.export', 'MTS') }}?q={{ urlencode($search) }}&sort={{ $sortField }}&dir={{ $sortDirection }}"
           style="margin-left:auto; padding:.5rem .75rem; border:1px solid #ddd; border-radius:.375rem; text-decoration:none;">
            Export Excel
        </a>
    </div>

    <div class="mt-3" style="overflow:auto;">
        <table style="width:100%; border-collapse: collapse; font-size:14px;">
            <thead>
            <tr style="background:#f9fafb;">
                <th style="text-align:left; padding:.5rem; border-bottom:1px solid #eee;">
                    <button wire:click="sortBy('students.nomor_pendaftaran')" style="all:unset; cursor:pointer;">No. Pendaftaran</button>
                </th>
                <th style="text-align:left; padding:.5rem; border-bottom:1px solid #eee;">
                    <button wire:click="sortBy('students.nama_lengkap')" style="all:unset; cursor:pointer;">Nama</button>
                </th>
                <th style="text-align:left; padding:.5rem; border-bottom:1px solid #eee;">
                    <button wire:click="sortBy('students.nisn')" style="all:unset; cursor:pointer;">NISN</button>
                </th>
                <th style="text-align:left; padding:.5rem; border-bottom:1px solid #eee;">NIK</th>
                {{-- <th style="text-align:left; padding:.5rem; border-bottom:1px solid #eee;">Status</th> --}}
                <th style="text-align:left; padding:.5rem; border-bottom:1px solid #eee;">Paid</th>
                <th style="text-align:left; padding:.5rem; border-bottom:1px solid #eee;">
                    <button wire:click="sortBy('students.created_at')" style="all:unset; cursor:pointer;">Tanggal Pendaftaran</button>
                </th>
            </tr>
            </thead>
            <tbody>
            @forelse($rows as $row)
                <tr>
                    <td style="padding:.5rem; border-bottom:1px solid #f2f2f2;">{{ $row->nomor_pendaftaran }}</td>
                    <td style="padding:.5rem; border-bottom:1px solid #f2f2f2;">{{ $row->nama_lengkap }}</td>
                    <td style="padding:.5rem; border-bottom:1px solid #f2f2f2;">{{ $row->nisn }}</td>
                    <td style="padding:.5rem; border-bottom:1px solid #f2f2f2;">{{ $row->nik_siswa }}</td>
                    {{-- <td style="padding:.5rem; border-bottom:1px solid #f2f2f2;">{{ $row->reg_status ?? '-' }}</td> --}}
                    <td style="padding:.5rem; border-bottom:1px solid #f2f2f2;">{{ $row->is_paid ? 'Yes' : 'No' }}</td>
                    <td style="padding:.5rem; border-bottom:1px solid #f2f2f2;">{{ $row->created_at?->format('Y-m-d H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="padding:.75rem; text-align:center; color:#777;">Tidak ada data</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $rows->links() }}
    </div>
</div>
