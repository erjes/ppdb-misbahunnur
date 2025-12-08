<div class="space-y-6">
  @if (session()->has('message'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-sm" role="alert">
      <div class="flex items-center">
        <i class="fa-solid fa-check-circle text-2xl mr-3"></i>
        <p class="font-medium">{{ session('message') }}</p>
      </div>
    </div>
  @endif

  <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200">
    <div class="bg-gradient-to-r from-green-600 to-green-700 px-6 py-4">
      <h2 class="text-xl font-bold text-white flex items-center">
        <i class="fa-solid fa-user-graduate mr-3"></i>
        Kelengkapan Dokumen Calon Siswa
      </h2>
    </div>
    <div class="p-6">
      <div class="grid md:grid-cols-2 gap-6">
        <div class="flex items-start space-x-3">
          <i class="fa-solid fa-user text-green-600 text-xl mt-1"></i>
          <div>
            <p class="text-sm text-gray-600 mb-1">Nama Lengkap</p>
            <p class="font-semibold text-gray-800 text-lg">{{ $student->nama_lengkap }}</p>
          </div>
        </div>
        <div class="flex items-start space-x-3">
          <i class="fa-solid fa-clipboard-check text-green-600 text-xl mt-1"></i>
          <div>
            <p class="text-sm text-gray-600 mb-1">Status Dokumen</p>
            @php
              $status = $student->registration->status ?? 'pending';
              $statusConfig = [
                  'pending' => [
                      'bg' => 'bg-yellow-100',
                      'text' => 'text-yellow-800',
                      'icon' => 'fa-clock',
                      'label' => 'Menunggu Verifikasi',
                  ],
                  'approved' => [
                      'bg' => 'bg-green-100',
                      'text' => 'text-green-800',
                      'icon' => 'fa-check-circle',
                      'label' => 'Diterima',
                  ],
                  'rejected' => [
                      'bg' => 'bg-red-100',
                      'text' => 'text-red-800',
                      'icon' => 'fa-times-circle',
                      'label' => 'Ditolak',
                  ],
              ];
              $currentStatus = $statusConfig[$status] ?? $statusConfig['pending'];
            @endphp
            <span
              class="{{ $currentStatus['bg'] }} {{ $currentStatus['text'] }} px-4 py-2 rounded-full text-sm font-semibold inline-flex items-center">
              <i class="fa-solid {{ $currentStatus['icon'] }} mr-2"></i>
              {{ $currentStatus['label'] }}
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200">
    <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-3">
      <h3 class="text-lg font-bold text-white flex items-center">
        <i class="fa-solid fa-pen-to-square mr-2"></i>
        Update Status Dokumen
      </h3>
    </div>
    <div class="p-6">
      <form wire:submit.prevent="updateStatus" class="space-y-4">
        <div class="grid md:grid-cols-3 gap-4">
          <div class="md:col-span-2">
            <label class="block text-sm font-semibold text-gray-700 mb-2">
              Pilih Status Baru
            </label>
            <select wire:model="newStatus" required
              class="block w-full bg-white border-2 border-blue-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 rounded-lg shadow-sm text-gray-700 py-3 px-4 transition-all">
              <option value="">-- Pilih Status --</option>
              <option value="approved">✓ Diterima</option>
              <option value="rejected">✗ Ditolak</option>
              <option value="pending">⏳ Menunggu</option>
            </select>
          </div>
          <div class="flex items-end">
            <button type="submit"
              class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold px-6 py-3 rounded-lg shadow-md transition-all duration-300 transform hover:-translate-y-0.5 flex items-center justify-center">
              <i class="fa-solid fa-save mr-2"></i>
              Update Status
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200">
    <div class="bg-gradient-to-r from-purple-600 to-purple-700 px-6 py-3">
      <h3 class="text-lg font-bold text-white flex items-center">
        <i class="fa-solid fa-folder-open mr-2"></i>
        Daftar Dokumen yang Diupload ({{ count($documents) }} dokumen)
      </h3>
    </div>
    <div class="p-6">
      @if (count($documents) > 0)
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
          @foreach ($documents as $index => $document)
            <div
              class="border-2 border-gray-200 rounded-xl p-4 hover:border-purple-400 hover:shadow-lg transition-all duration-300 bg-gradient-to-br from-white to-purple-50/30">
              <div class="flex items-center justify-between mb-3">
                <span
                  class="bg-purple-600 text-white w-8 h-8 rounded-lg flex items-center justify-center text-sm font-bold shadow-md">
                  {{ $index + 1 }}
                </span>
                <span class="text-xs text-gray-500">
                  <i class="fa-solid fa-calendar mr-1"></i>
                  {{ $document->created_at ? $document->created_at->format('d/m/Y') : '-' }}
                </span>
              </div>

              <div class="mb-3">
                <p class="text-xs text-gray-600 mb-1 font-medium">Jenis Dokumen</p>
                <p class="font-semibold text-gray-800 flex items-center">
                  <i class="fa-solid fa-file-alt text-purple-600 mr-2"></i>
                  {{ ucwords(str_replace('_', ' ', $document->jenis_dokumen)) }}
                </p>
              </div>

              @if ($document->no_dokumen)
                <div class="mb-3">
                  <p class="text-xs text-gray-600 mb-1 font-medium">Nomor Dokumen</p>
                  <p class="text-sm text-gray-700 bg-gray-100 px-3 py-1 rounded-lg font-mono">
                    {{ $document->no_dokumen }}
                  </p>
                </div>
              @endif

              <div class="mt-4">
                @if ($document->file_path)
                  @php
                    $url = route('admin.documents.show', [
                        'studentId' => $student->id,
                        'filename' => basename($document->file_path),
                    ]);
                  @endphp

                  <div
                    class="block group relative overflow-hidden rounded-lg border-2 border-purple-200 hover:border-purple-400 transition-all">
                    <img src="{{ $url }}" alt="Dokumen {{ $document->jenis_dokumen }}"
                      class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-110">

                    {{-- <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all duration-300 flex items-center justify-center">
                                            <div class="transform scale-0 group-hover:scale-100 transition-transform duration-300">
                                                <div class="bg-white text-purple-600 px-4 py-2 rounded-lg font-semibold shadow-xl flex items-center">
                                                    <i class="fa-solid fa-eye mr-2"></i>
                                                    Lihat Dokumen
                                                </div>
                                            </div>
                                        </div> --}}
                  </div>

                  <a href="{{ $url }}" target="_blank"
                    class="mt-2 block w-full bg-purple-600 hover:bg-purple-700 text-white text-center py-2 rounded-lg font-medium transition-all duration-300 transform hover:-translate-y-0.5 shadow-md hover:shadow-lg">
                    <i class="fa-solid fa-external-link-alt mr-2"></i>
                    Buka di Tab Baru
                  </a>
                @else
                  <div class="bg-gray-100 border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                    <i class="fa-solid fa-file-circle-xmark text-gray-400 text-3xl mb-2"></i>
                    <p class="text-sm text-gray-500 font-medium">Tidak ada dokumen</p>
                  </div>
                @endif
              </div>
            </div>
          @endforeach
        </div>
      @else
        <div class="text-center py-12">
          <i class="fa-solid fa-inbox text-gray-300 text-6xl mb-4"></i>
          <h4 class="text-xl font-semibold text-gray-600 mb-2">Belum Ada Dokumen</h4>
          <p class="text-gray-500">Calon siswa belum mengupload dokumen apapun</p>
        </div>
      @endif
    </div>
  </div>

  <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border-l-4 border-blue-500 p-5 rounded-lg shadow-sm">
    <div class="flex items-start">
      <i class="fa-solid fa-info-circle text-blue-600 text-xl mr-3 mt-1"></i>
      <div>
        <p class="font-semibold text-blue-800 mb-2">Informasi Verifikasi Dokumen</p>
        <ul class="text-sm text-blue-700 space-y-1 list-disc list-inside">
          <li>Periksa setiap dokumen dengan teliti sebelum memberikan status</li>
          <li>Status "Diterima" akan memungkinkan siswa untuk melanjutkan proses</li>
          <li>Status "Ditolak" memerlukan siswa untuk mengupload ulang dokumen</li>
          <li>Klik pada gambar dokumen untuk melihat dalam ukuran penuh</li>
        </ul>
      </div>
    </div>
  </div>
</div>
