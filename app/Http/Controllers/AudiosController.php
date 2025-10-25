<?php

namespace App\Http\Controllers;

use App\Models\audios;
use App\Http\Requests\StoreaudiosRequest;
use App\Http\Requests\UpdateaudiosRequest;

class AudiosController extends Controller
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
    public function store(StoreaudiosRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(audios $audios)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(audios $audios)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateaudiosRequest $request, audios $audios)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(audios $audios)
    {
        //
    }
}
