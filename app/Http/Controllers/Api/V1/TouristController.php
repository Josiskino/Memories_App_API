<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Tourist;
use App\Http\Requests\StoreTouristRequest;
use App\Http\Requests\UpdateTouristRequest;
use Illuminate\Http\Request;

class TouristController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTouristRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Tourist $tourist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTouristRequest $request, Tourist $tourist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tourist $tourist)
    {
        //
    }
}
