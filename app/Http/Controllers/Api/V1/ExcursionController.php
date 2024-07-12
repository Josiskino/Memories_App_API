<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Excursion;
use App\Http\Requests\StoreExcursionRequest;
use App\Http\Requests\UpdateExcursionRequest;
use Illuminate\Http\Request;

class ExcursionController extends Controller
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
    public function store(StoreExcursionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Excursion $excursion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExcursionRequest $request, Excursion $excursion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Excursion $excursion)
    {
        //
    }
}
