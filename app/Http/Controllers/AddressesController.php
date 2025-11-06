<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Http\Requests\StoreaddressesRequest;
use App\Http\Requests\UpdateaddressesRequest;
use Illuminate\Http\Request;

class AddressesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $addresses = Address::with('student')->latest()->paginate(15);
        
        return view('admin.addresses.index', [
            'addresses' => $addresses,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreaddressesRequest $request)
    {
        $validated = $request->validated();
        
        try {
            $address = Address::create($validated);
            
            return redirect()
                ->route('admin.addresses.index')
                ->with('status', 'Alamat berhasil ditambahkan');
        } catch (\Throwable $e) {
            return back()->withErrors('Gagal menambah alamat');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $address = Address::with('student')->find($id);
        
        if (!$address) {
            abort(404);
        }
        
        return view('admin.addresses.show', [
            'address' => $address,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateaddressesRequest $request, $id)
    {
        $address = Address::find($id);
        
        if (!$address) {
            return back()->withErrors('Alamat tidak ditemukan');
        }
        
        $validated = $request->validated();
        
        try {
            $address->update($validated);
            
            return redirect()
                ->route('admin.addresses.show', $address->id)
                ->with('status', 'Alamat berhasil diperbarui');
        } catch (\Throwable $e) {
            return back()->withErrors('Gagal memperbarui alamat');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $address = Address::find($id);
        
        if (!$address) {
            return back()->withErrors('Alamat tidak ditemukan');
        }
        
        try {
            $address->delete();
            
            return redirect()
                ->route('admin.addresses.index')
                ->with('status', 'Alamat berhasil dihapus');
        } catch (\Throwable $e) {
            return back()->withErrors('Gagal menghapus alamat');
        }
    }
}
