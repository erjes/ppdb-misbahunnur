<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Http\Requests\StoregradesRequest;
use App\Http\Requests\UpdategradesRequest;
use Illuminate\Http\Request;

class GradesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grades = Grade::with('student')->latest()->paginate(15);
        
        return view('grades.index', [
            'grades' => $grades,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoregradesRequest $request)
    {
        $validated = $request->validated();
        
        try {
            $grade = Grade::create($validated);
            
            return redirect()
                ->route('grades.index')
                ->with('status', 'Nilai berhasil ditambahkan');
        } catch (\Throwable $e) {
            return back()->withErrors('Gagal menambah nilai');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $grade = Grade::with('student')->find($id);
        
        if (!$grade) {
            abort(404);
        }
        
        return view('grades.show', [
            'grade' => $grade,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdategradesRequest $request, $id)
    {
        $grade = Grade::find($id);
        
        if (!$grade) {
            return back()->withErrors('Nilai tidak ditemukan');
        }
        
        $validated = $request->validated();
        
        try {
            $grade->update($validated);
            
            return redirect()
                ->route('grades.show', $grade->id)
                ->with('status', 'Nilai berhasil diperbarui');
        } catch (\Throwable $e) {
            return back()->withErrors('Gagal memperbarui nilai');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $grade = Grade::find($id);
        
        if (!$grade) {
            return back()->withErrors('Nilai tidak ditemukan');
        }
        
        try {
            $grade->delete();
            
            return redirect()
                ->route('grades.index')
                ->with('status', 'Nilai berhasil dihapus');
        } catch (\Throwable $e) {
            return back()->withErrors('Gagal menghapus nilai');
        }
    }
}
