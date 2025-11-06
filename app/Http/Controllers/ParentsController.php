<?php

namespace App\Http\Controllers;

use App\Models\ParentData;
use App\Http\Requests\StoreparentsRequest;
use App\Http\Requests\UpdateparentsRequest;
use Illuminate\Http\Request;

class ParentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parents = ParentData::with('student')->latest()->paginate(15);
        
        return view('admin.parents.index', [
            'parents' => $parents,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreparentsRequest $request)
    {
        $validated = $request->validated();
        
        try {
            $parent = ParentData::create($validated);
            
            return redirect()
                ->route('admin.parents.index')
                ->with('status', 'Data orang tua berhasil ditambahkan');
        } catch (\Throwable $e) {
            return back()->withErrors('Gagal menambah data orang tua');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $parent = ParentData::with('student')->find($id);
        
        if (!$parent) {
            abort(404);
        }
        
        return view('admin.parents.show', [
            'parent' => $parent,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateparentsRequest $request, $id)
    {
        $parent = ParentData::find($id);
        
        if (!$parent) {
            return back()->withErrors('Data orang tua tidak ditemukan');
        }
        
        $validated = $request->validated();
        
        try {
            $parent->update($validated);
            
            return redirect()
                ->route('admin.parents.show', $parent->id)
                ->with('status', 'Data orang tua berhasil diperbarui');
        } catch (\Throwable $e) {
            return back()->withErrors('Gagal memperbarui data orang tua');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $parent = ParentData::find($id);
        
        if (!$parent) {
            return back()->withErrors('Data orang tua tidak ditemukan');
        }
        
        try {
            $parent->delete();
            
            return redirect()
                ->route('admin.parents.index')
                ->with('status', 'Data orang tua berhasil dihapus');
        } catch (\Throwable $e) {
            return back()->withErrors('Gagal menghapus data orang tua');
        }
    }
}
