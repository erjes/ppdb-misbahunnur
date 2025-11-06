<?php

namespace App\Http\Controllers;

use App\Models\Audio;
use App\Http\Requests\StoreaudiosRequest;
use App\Http\Requests\UpdateaudiosRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class AudiosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $audios = Audio::with('uploader')->latest()->paginate(15);
        
        return view('admin.audios.index', [
            'audios' => $audios,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreaudiosRequest $request)
    {
        if (Auth::check()) {
            request()->merge(['uploaded_by' => Auth::id()]);
        }

        $validated = $request->validated();
        
        try {
            // Handle file upload if present
            if (request()->hasFile('file')) {
                $file = request()->file('file');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('audios', $filename, 'public');
                $validated['file'] = $path;
            }
            
            $audio = Audio::create($validated);
            
            return redirect()
                ->route('admin.audios.index')
                ->with('status', 'Audio berhasil ditambahkan');
        } catch (\Throwable $e) {
            return back()->withErrors('Gagal menambah audio');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $audio = Audio::with('uploader')->find($id);
        
        if (!$audio) {
            abort(404);
        }
        
        return view('admin.audios.show', [
            'audio' => $audio,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateaudiosRequest $request, $id)
    {
        $audio = Audio::find($id);
        
        if (!$audio) {
            return back()->withErrors('Audio tidak ditemukan');
        }
        
        $validated = $request->validated();

        // Prevent changing the uploader via update
        unset($validated['uploaded_by']);
        
        try {
            // Handle file upload if present
            if (request()->hasFile('file')) {
                // Delete old file if exists
                if ($audio->file && Storage::disk('public')->exists($audio->file)) {
                    Storage::disk('public')->delete($audio->file);
                }
                
                $file = request()->file('file');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('audios', $filename, 'public');
                $validated['file'] = $path;
            }
            
            $audio->update($validated);
            
            return redirect()
                ->route('admin.audios.show', $audio->id)
                ->with('status', 'Audio berhasil diperbarui');
        } catch (\Throwable $e) {
            return back()->withErrors('Gagal memperbarui audio');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $audio = Audio::find($id);
        
        if (!$audio) {
            return back()->withErrors('Audio tidak ditemukan');
        }
        
        try {
            // Delete file if exists
            if ($audio->file && Storage::disk('public')->exists($audio->file)) {
                Storage::disk('public')->delete($audio->file);
            }
            
            $audio->delete();
            
            return redirect()
                ->route('admin.audios.index')
                ->with('status', 'Audio berhasil dihapus');
        } catch (\Throwable $e) {
            return back()->withErrors('Gagal menghapus audio');
        }
    }
}
