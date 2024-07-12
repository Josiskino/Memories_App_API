<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Renter;
use App\Http\Requests\StoreRenterRequest;
use App\Http\Requests\UpdateRenterRequest;
use Illuminate\Http\Request;

class RenterController extends Controller
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
    public function store(StoreRenterRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Renter $renter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRenterRequest $request, Renter $renter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Renter $renter)
    {
        //
    }
}
