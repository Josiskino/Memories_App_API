<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Supervision;
use App\Http\Requests\StoreSupervisionRequest;
use App\Http\Requests\UpdateSupervisionRequest;
use Illuminate\Http\Request;

class SupervisionController extends Controller
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
    public function store(StoreSupervisionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Supervision $supervision)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSupervisionRequest $request, Supervision $supervision)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supervision $supervision)
    {
        //
    }
}
