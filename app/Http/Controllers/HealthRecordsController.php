<?php

namespace App\Http\Controllers;

use App\Models\health_records;
use App\Http\Requests\Storehealth_recordsRequest;
use App\Http\Requests\Updatehealth_recordsRequest;

class HealthRecordsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Storehealth_recordsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(health_records $health_records)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(health_records $health_records)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updatehealth_recordsRequest $request, health_records $health_records)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(health_records $health_records)
    {
        //
    }
}
