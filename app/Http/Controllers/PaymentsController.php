<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Http\Requests\StorepaymentsRequest;
use App\Http\Requests\UpdatepaymentsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $payments = Payment::with(['user', 'fee'])->latest()->paginate(15);
        
        // return view('payments.index', [
        //     'payments' => $payments,
        // ]);
        return view('admin.payments.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorepaymentsRequest $request)
    {
        // $validated = $request->validated();
        
        // try {
        //     // Handle file upload if present
        //     if ($request->hasFile('bukti')) {
        //         $file = $request->file('bukti');
        //         $filename = time() . '_' . $file->getClientOriginalName();
        //         $path = $file->storeAs('payments', $filename, 'public');
        //         $validated['bukti'] = $path;
        //     }
            
        //     $payment = Payment::create($validated);
            
        //     return redirect()
        //         ->route('payments.index')
        //         ->with('status', 'Pembayaran berhasil ditambahkan');
        // } catch (\Throwable $e) {
        //     return back()->withErrors('Gagal menambah pembayaran');
        // }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // $payment = Payment::with(['user', 'fee'])->find($id);
        
        // if (!$payment) {
        //     abort(404);
        // }
        
        // return view('payments.show', [
        //     'payment' => $payment,
        // ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatepaymentsRequest $request, $id)
    {
        // $payment = Payment::find($id);
        
        // if (!$payment) {
        //     return back()->withErrors('Pembayaran tidak ditemukan');
        // }
        
        // $validated = $request->validated();
        
        // try {
        //     // Handle file upload if present
        //     if ($request->hasFile('bukti')) {
        //         // Delete old file if exists
        //         if ($payment->bukti && Storage::disk('public')->exists($payment->bukti)) {
        //             Storage::disk('public')->delete($payment->bukti);
        //         }
                
        //         $file = $request->file('bukti');
        //         $filename = time() . '_' . $file->getClientOriginalName();
        //         $path = $file->storeAs('payments', $filename, 'public');
        //         $validated['bukti'] = $path;
        //     }
            
        //     $payment->update($validated);
            
        //     return redirect()
        //         ->route('payments.show', $payment->id)
        //         ->with('status', 'Pembayaran berhasil diperbarui');
        // } catch (\Throwable $e) {
        //     return back()->withErrors('Gagal memperbarui pembayaran');
        // }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
    //     $payment = Payment::find($id);
        
    //     if (!$payment) {
    //         return back()->withErrors('Pembayaran tidak ditemukan');
    //     }
        
    //     try {
    //         // Delete file if exists
    //         if ($payment->bukti && Storage::disk('public')->exists($payment->bukti)) {
    //             Storage::disk('public')->delete($payment->bukti);
    //         }
            
    //         $payment->delete();
            
    //         return redirect()
    //             ->route('payments.index')
    //             ->with('status', 'Pembayaran berhasil dihapus');
    //     } catch (\Throwable $e) {
    //         return back()->withErrors('Gagal menghapus pembayaran');
    //     }
    }
}
