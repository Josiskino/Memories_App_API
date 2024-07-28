<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Http\Resources\HotelResource;
use App\Http\Requests\StoreHotelRequest;
use App\Http\Requests\UpdateHotelRequest;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hotels = Hotel::all();
        return HotelResource::collection($hotels);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHotelRequest $request)
    {
        $validated = $request->validate([
            'hotelName' => 'required|string|max:255',
            'hotelCity' => 'required|string|max:255',
            'hotelEmail' => 'required|email|max:255',
            'hotelPhone' => 'required|string|max:20',
            'status' => 'required|integer',
        ]);

        $hotel = Hotel::create($validated);

        return new HotelResource($hotel);
    }

    /**
     * Display the specified resource.
     */
    public function show(Hotel $hotel)
    {
        return new HotelResource($hotel);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHotelRequest $request, Hotel $hotel)
    {
        $validated = $request->validate([
            'hotelName' => 'sometimes|required|string|max:255',
            'hotelCity' => 'sometimes|required|string|max:255',
            'hotelEmail' => 'sometimes|required|email|max:255',
            'hotelPhone' => 'sometimes|required|string|max:20',
            'status' => 'sometimes|required|integer',
        ]);

        $hotel->update($validated);

        return new HotelResource($hotel);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hotel $hotel)
    {
        $hotel->delete();

        return response()->noContent();
    }
}
