<?php

namespace App\Http\Controllers;

use App\Models\HealthRecord;
use App\Http\Requests\Storehealth_recordsRequest;
use App\Http\Requests\Updatehealth_recordsRequest;
use Illuminate\Http\Request;

class HealthRecordsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $healthRecords = HealthRecord::with('student')->latest()->paginate(15);
        
        return view('admin.health_records.index', [
            'healthRecords' => $healthRecords,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Storehealth_recordsRequest $request)
    {
        $validated = $request->validated();
        
        try {
            $healthRecord = HealthRecord::create($validated);
            
            return redirect()
                ->route('admin.health-records.index')
                ->with('status', 'Data kesehatan berhasil ditambahkan');
        } catch (\Throwable $e) {
            return back()->withErrors('Gagal menambah data kesehatan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $healthRecord = HealthRecord::with('student')->find($id);
        
        if (!$healthRecord) {
            abort(404);
        }
        
        return view('admin.health_records.show', [
            'healthRecord' => $healthRecord,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updatehealth_recordsRequest $request, $id)
    {
        $healthRecord = HealthRecord::find($id);
        
        if (!$healthRecord) {
            return back()->withErrors('Data kesehatan tidak ditemukan');
        }
        
        $validated = $request->validated();
        
        try {
            $healthRecord->update($validated);
            
            return redirect()
                ->route('admin.health-records.show', $healthRecord->id)
                ->with('status', 'Data kesehatan berhasil diperbarui');
        } catch (\Throwable $e) {
            return back()->withErrors('Gagal memperbarui data kesehatan');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $healthRecord = HealthRecord::find($id);
        
        if (!$healthRecord) {
            return back()->withErrors('Data kesehatan tidak ditemukan');
        }
        
        try {
            $healthRecord->delete();
            
            return redirect()
                ->route('admin.health-records.index')
                ->with('status', 'Data kesehatan berhasil dihapus');
        } catch (\Throwable $e) {
            return back()->withErrors('Gagal menghapus data kesehatan');
        }
    }
}
