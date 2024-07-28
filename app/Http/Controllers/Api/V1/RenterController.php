<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Renter;
use App\Http\Requests\StoreRenterRequest;
use App\Http\Requests\UpdateRenterRequest;
use App\Http\Resources\RenterResource;
use Illuminate\Http\Request;

class RenterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $renters = Renter::paginate(10);
        return RenterResource::collection($renters);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRenterRequest $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:renters,email',
            'phone_number' => 'nullable|string|max:255',
            'status' => 'required|integer',
        ]);

        $renter = Renter::create($validated);

        return new RenterResource($renter);
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
        $validated = $request->validate([
            'first_name' => 'sometimes|required|string|max:255',
            'last_name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:renters,email,' . $renter->id,
            'phone_number' => 'nullable|string|max:255',
            'status' => 'sometimes|required|integer',
        ]);

        $renter->update($validated);

        return new RenterResource($renter);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Renter $renter)
    {
        $renter->delete();

        return response()->noContent();
    }
}
