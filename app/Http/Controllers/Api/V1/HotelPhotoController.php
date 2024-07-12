<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\HotelPhoto;
use App\Http\Requests\StoreHotelPhotoRequest;
use App\Http\Requests\UpdateHotelPhotoRequest;
use Illuminate\Http\Request;

class HotelPhotoController extends Controller
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
    public function store(StoreHotelPhotoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(HotelPhoto $hotelPhoto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHotelPhotoRequest $request, HotelPhoto $hotelPhoto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HotelPhoto $hotelPhoto)
    {
        //
    }
}
