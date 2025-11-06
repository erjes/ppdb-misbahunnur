<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoredocumentsRequest;
use App\Http\Requests\UpdatedocumentsRequest;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class DocumentsController extends Controller
{
    public function index()
    {
        $documents = Document::with('student')->latest()->paginate(15);
        
        return view('admin.documents.index', [
            'documents' => $documents,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoredocumentsRequest $request)
    {
        $validated = $request->validated();
        
        try {
            // Handle file upload if present
            if (request()->hasFile('file')) {
                $file = request()->file('file');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('documents', $filename, 'public');
                $validated['file_path'] = $path;
            }
            
            $document = Document::create($validated);
            
            return redirect()
                ->route('admin.documents.index')
                ->with('status', 'Dokumen berhasil ditambahkan');
        } catch (\Throwable $e) {
            return back()->withErrors('Gagal menambah dokumen');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $document = Document::with('student')->find($id);
        
        if (!$document) {
            abort(404);
        }
        
        return view('admin.documents.show', [
            'document' => $document,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatedocumentsRequest $request, $id)
    {
        $document = Document::find($id);
        
        if (!$document) {
            return back()->withErrors('Dokumen tidak ditemukan');
        }
        
        $validated = $request->validated();
        
        try {
            // Handle file upload if present
            if (request()->hasFile('file')) {
                if ($document->file_path && Storage::disk('public')->exists($document->file_path)) {
                    Storage::disk('public')->delete($document->file_path);
                }
                
                $file = request()->file('file');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('documents', $filename, 'public');
                $validated['file_path'] = $path;
            }
            
            $document->update($validated);
            
            return redirect()
                ->route('admin.documents.show', $document->id)
                ->with('status', 'Dokumen berhasil diperbarui');
        } catch (\Throwable $e) {
            return back()->withErrors('Gagal memperbarui dokumen');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $document = Document::find($id);
        
        if (!$document) {
            return back()->withErrors('Dokumen tidak ditemukan');
        }
        
        try {
            // Delete file if exists
            if ($document->file_path && Storage::disk('public')->exists($document->file_path)) {
                Storage::disk('public')->delete($document->file_path);
            }
            
            $document->delete();
            
            return redirect()
                ->route('admin.documents.index')
                ->with('status', 'Dokumen berhasil dihapus');
        } catch (\Throwable $e) {
            return back()->withErrors('Gagal menghapus dokumen');
        }
    }
}
