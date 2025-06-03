<?php

namespace App\Http\Controllers;

use App\Models\computer;
use App\Http\Requests\StorecomputerRequest;
use App\Http\Requests\UpdatecomputerRequest;

class ComputerController extends Controller
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
    public function store(StorecomputerRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(computer $computer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(computer $computer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatecomputerRequest $request, computer $computer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(computer $computer)
    {
        //
    }
}
