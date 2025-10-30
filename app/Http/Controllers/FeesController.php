<?php

namespace App\Http\Controllers;

use App\Models\Fee;
use App\Http\Requests\StorefeesRequest;
use App\Http\Requests\UpdatefeesRequest;
use Illuminate\Http\Request;

class FeesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fees = Fee::with('payments')->latest()->paginate(15);
        
        return view('fees.index', [
            'fees' => $fees,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorefeesRequest $request)
    {
        $validated = $request->validated();
        
        try {
            $fee = Fee::create($validated);
            
            return redirect()
                ->route('fees.index')
                ->with('status', 'Biaya berhasil ditambahkan');
        } catch (\Throwable $e) {
            return back()->withErrors('Gagal menambah biaya');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $fee = Fee::with('payments')->find($id);
        
        if (!$fee) {
            abort(404);
        }
        
        return view('fees.show', [
            'fee' => $fee,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatefeesRequest $request, $id)
    {
        $fee = Fee::find($id);
        
        if (!$fee) {
            return back()->withErrors('Biaya tidak ditemukan');
        }
        
        $validated = $request->validated();
        
        try {
            $fee->update($validated);
            
            return redirect()
                ->route('fees.show', $fee->id)
                ->with('status', 'Biaya berhasil diperbarui');
        } catch (\Throwable $e) {
            return back()->withErrors('Gagal memperbarui biaya');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $fee = Fee::find($id);
        
        if (!$fee) {
            return back()->withErrors('Biaya tidak ditemukan');
        }
        
        try {
            $fee->delete();
            
            return redirect()
                ->route('fees.index')
                ->with('status', 'Biaya berhasil dihapus');
        } catch (\Throwable $e) {
            return back()->withErrors('Gagal menghapus biaya');
        }
    }
}
