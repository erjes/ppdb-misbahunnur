<div>
    <h2>Kelengkapan Dokumen Calon Siswa: {{ $student->nama_lengkap }}</h2>

    @foreach ($documents as $document)
        <div>
            <p><strong>Jenis Dokumen:</strong> {{ $document->jenis_dokumen }}</p>
            <p><strong>Nomor Dokumen:</strong> {{ $document->no_dokumen ?? 'Tidak tersedia' }}</p>
            <p><strong>File Path:</strong> 
                @if($document->file_path)
                <a href="{{ route('documents.show', ['studentId' => $student->id, 'filename' => basename($document->file_path)]) }}" target="_blank">Lihat Dokumen</a>
                @else
                    Tidak ada dokumen yang diupload
                @endif
            </p>
            <hr>
        </div>
    @endforeach
</div>
