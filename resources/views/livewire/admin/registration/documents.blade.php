<div>
    <h2>Kelengkapan Dokumen Calon Siswa: {{ $student->nama_lengkap }}</h2>
    <p><strong>Status Dokumen:</strong> {{ $student->registration->status ?? 'Tidak tersedia' }}</p>
    <h3>Update Status Dokumen</h3>
    <form wire:submit.prevent="updateStatus">
        <select wire:model="newStatus" required>
            <option value="">Pilih Status</option>
            <option value="approved">Diterima</option>
            <option value="rejected">Ditolak</option>
            <option value="pending">Menunggu</option>
        </select>
        <button type="submit">Update Status</button>
    </form>
    @foreach ($documents as $document)
        <div>
            <p><strong>Jenis Dokumen:</strong> {{ $document->jenis_dokumen }}</p>
            <p><strong>Nomor Dokumen:</strong> {{ $document->no_dokumen ?? 'Tidak tersedia' }}</p>
            <p><strong>File Path:</strong> 

                @if($document->file_path)
                @php
                $url = route('admin.documents.show', [
                    'studentId' => $student->id,
                    'filename'  => basename($document->file_path),
                ]);
               @endphp
            
                <a href="{{ $url }}" target="_blank">
                    <img src="{{ $url }}"
                        alt="Dokumen {{ $document->jenis ?? '' }}"
                        width="200"
                        style="cursor: pointer;">
                </a>
            
                @else
                    Tidak ada dokumen yang diupload
                @endif
            </p>
            <hr>
        </div>
    @endforeach
</div>
