<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Participation;
use App\Http\Requests\StoreParticipationRequest;
use App\Http\Requests\UpdateParticipationRequest;
use Illuminate\Http\Request;

class ParticipationController extends Controller
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
    public function store(StoreParticipationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Participation $participation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateParticipationRequest $request, Participation $participation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Participation $participation)
    {
        //
    }
}
