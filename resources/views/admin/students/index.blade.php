<x-app-layout>
    <div class="max-w-7xl mx-auto p-6">
        <div class="bg-white shadow rounded-lg overflow-hidden">

            <div class="p-6 overflow-x-auto">
                <table class="min-w-full border border-gray-200 divide-y divide-gray-300">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider border">NO</th>
                            <th class="px-4 py-2 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider border">Nama Lengkap</th>
                            <th class="px-4 py-2 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider border">Nomor Pendaftaran</th>
                            <th class="px-4 py-2 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider border">User Type</th>
                            <th class="px-4 py-2 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider border">Detail</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($submissions as $index => $submission)
                            @php
                                $studentData = is_array($submission->submission_data)
                                    ? $submission->submission_data
                                    : json_decode($submission->submission_data, true);
                            @endphp

                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 border">{{ $index + 1 }}</td>
                                <td class="px-4 py-2 border">{{ $studentData['nama_lengkap'] ?? '-' }}</td>
                                <td class="px-4 py-2 border">{{ $studentData['nomor_pendaftaran'] ?? '-' }}</td>
                                <td class="px-4 py-2 border">{{ $submission->user_type ?? '-' }}</td>
                                <td class="px-4 py-2 border">
                                    <button onclick="toggleDetails({{ $submission->id }})"
                                        class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700 transition">
                                        Lihat Detail
                                    </button>
                                </td>
                            </tr>
                            
                            {{-- Detail Row --}}
                            <tr id="details-{{ $submission->id }}" class="hidden bg-gray-50">
                                <td colspan="5" class="px-6 py-4">
                                    <table class="min-w-full border border-gray-200 divide-y divide-gray-200 text-sm">
                                        <thead class="bg-gray-200">
                                            <tr>
                                                <th class="px-4 py-2 text-left border w-1/3">Data</th>
                                                <th class="px-4 py-2 text-left border">Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($studentData as $key => $value)
                                                <tr>
                                                    <td class="px-4 py-2 border font-medium text-gray-700 capitalize">
                                                        {{ str_replace('_', ' ', $key) }}
                                                    </td>
                                                    <td class="px-4 py-2 border text-gray-700">
                                                        @if(is_string($value) && preg_match('/\.(jpg|jpeg|png|gif|webp|svg)$/i', $value))
                                                            <a href="{{ asset(str_replace('public/', 'storage/', $value)) }}" target="_blank">
                                                                <img src="{{ asset(str_replace('public/', 'storage/', $value)) }}" 
                                                                    alt="image" class="h-20 rounded shadow">
                                                            </a>
                                                        @elseif(is_array($value) || is_object($value))
                                                            <span class="text-red-500">[Array/Object]</span>
                                                        @else
                                                            {{ $value ?? '-' }}
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @if($submissions->isEmpty())
                    <div class="text-center text-gray-500 py-6">Belum ada data submission.</div>
                @endif
            </div>
        </div>
    </div>

    <script>
        function toggleDetails(id) {
            const row = document.getElementById('details-' + id);
            row.classList.toggle('hidden');
        }
    </script>
</x-app-layout>
