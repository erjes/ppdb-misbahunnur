<div>
  <div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-2">Data Pendaftaran Siswa</h1>
    <p class="text-sm text-gray-600">Kelola dan pantau pendaftaran siswa baru</p>
  </div>

  <div class="bg-white rounded-lg shadow-lg overflow-hidden border border-gray-200">
    <div class="overflow-x-auto">
      <table class="w-full min-w-full divide-y divide-gray-200">
        <thead class="bg-gradient-to-r from-green-600 to-green-700">
          <tr>
            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
              No
            </th>
            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
              Nomor Pendaftaran
            </th>
            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
              Nama Lengkap
            </th>
            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
              Jenis Kelamin
            </th>
            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
              Status Pendaftaran
            </th>
            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
              Jenjang Pendaftaran
            </th>
            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
              Jalur Pendaftaran
            </th>
            <th class="px-6 py-4 text-center text-xs font-semibold text-white uppercase tracking-wider">
              Action
            </th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          @foreach ($students as $index => $student)
            <tr class="hover:bg-green-50 transition-colors duration-200">
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                {{ $index + 1 }}
              </td>

              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <div class="flex-shrink-0 h-10 w-10 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-id-card text-green-600"></i>
                  </div>
                  <div class="ml-3">
                    <p class="text-sm font-medium text-gray-900">
                      {{ $student->nomor_pendaftaran }}
                    </p>
                  </div>
                </div>
              </td>

              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm font-medium text-gray-900">
                  {{ $student->nama_lengkap }}
                </div>
              </td>

              <td class="px-6 py-4 whitespace-nowrap">
                @if ($student->jenis_kelamin == 'L')
                  <span
                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                    <i class="fas fa-mars mr-1.5"></i>
                    Laki-Laki
                  </span>
                @else
                  <span
                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-pink-100 text-pink-800">
                    <i class="fas fa-venus mr-1.5"></i>
                    Perempuan
                  </span>
                @endif
              </td>

              <td class="px-6 py-4 whitespace-nowrap">
                @php
                  $status = $student->registration->status ?? 'Pending';
                  $statusClass = match ($status) {
                      'Diterima' => 'bg-green-100 text-green-800',
                      'Ditolak' => 'bg-red-100 text-red-800',
                      default => 'bg-yellow-100 text-yellow-800',
                  };
                  $statusIcon = match ($status) {
                      'Diterima' => 'fa-check-circle',
                      'Ditolak' => 'fa-times-circle',
                      default => 'fa-clock',
                  };
                @endphp
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $statusClass }}">
                  <i class="fas {{ $statusIcon }} mr-1.5"></i>
                  {{ $status }}
                </span>
              </td>

              <td class="px-6 py-4 whitespace-nowrap">
                <span
                  class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                  <i class="fas fa-graduation-cap mr-1.5"></i>
                  {{ $student->registration->jenjang_daftar ?? 'Pending' }}
                </span>
              </td>

              <td class="px-6 py-4 whitespace-nowrap">
                <span
                  class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                  <i class="fas fa-route mr-1.5"></i>
                  {{ $student->registration->jalur_daftar ?? 'Pending' }}
                </span>
              </td>

              <td class="px-6 py-4 whitespace-nowrap text-center">
                <div class="flex items-center justify-center space-x-2">
                  <a href="{{ route('admin.registrations.status', $student->nomor_pendaftaran) }}"
                    class="inline-flex items-center px-3 py-2 bg-green-600 hover:bg-green-700 text-white text-xs font-medium rounded-lg transition-all duration-200 shadow-sm hover:shadow-md">
                    <i class="fas fa-eye mr-1.5"></i>
                    Detail
                  </a>
                  <a href="{{ route('admin.registrations.documents', $student->nomor_pendaftaran) }}"
                    class="inline-flex items-center px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-medium rounded-lg transition-all duration-200 shadow-sm hover:shadow-md">
                    <i class="fas fa-file-alt mr-1.5"></i>
                    Dokumen
                  </a>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

  <style>
    .overflow-x-auto::-webkit-scrollbar {
      height: 8px;
    }

    .overflow-x-auto::-webkit-scrollbar-track {
      background: #f1f5f9;
      border-radius: 4px;
    }

    .overflow-x-auto::-webkit-scrollbar-thumb {
      background: #16a34a;
      border-radius: 4px;
    }

    .overflow-x-auto::-webkit-scrollbar-thumb:hover {
      background: #15803d;
    }
  </style>
</div>
