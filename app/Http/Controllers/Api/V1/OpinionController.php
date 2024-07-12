<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Opinion;
use App\Http\Requests\StoreOpinionRequest;
use App\Http\Requests\UpdateOpinionRequest;
use Illuminate\Http\Request;

class OpinionController extends Controller
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
    public function store(StoreOpinionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Opinion $opinion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOpinionRequest $request, Opinion $opinion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Opinion $opinion)
    {
        //
    }
}
