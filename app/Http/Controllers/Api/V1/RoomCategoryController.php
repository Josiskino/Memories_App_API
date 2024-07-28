<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\RoomCategory;
use App\Http\Resources\RoomCategoryResource;
use App\Http\Requests\StoreRoomCategoryRequest;
use App\Http\Requests\UpdateRoomCategoryRequest;
use Illuminate\Http\Request;

class RoomCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roomCategories = RoomCategory::all();
        return RoomCategoryResource::collection($roomCategories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoomCategoryRequest $request)
    {
        $validated = $request->validate([
            'categoryName' => 'required|string|max:255',
            'categoryDescription' => 'required|string',
            'hotel_id' => 'required|exists:hotels,id',
            'status' => 'required|integer',
        ]);

        $roomCategory = RoomCategory::create($validated);

        return new RoomCategoryResource($roomCategory);
    }

    /**
     * Display the specified resource.
     */
    public function show(RoomCategory $roomCategory)
    {
        return new RoomCategoryResource($roomCategory);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoomCategoryRequest $request, RoomCategory $roomCategory)
    {
        $validated = $request->validate([
            'categoryName' => 'sometimes|required|string|max:255',
            'categoryDescription' => 'sometimes|required|string',
            'hotel_id' => 'sometimes|required|exists:hotels,id',
            'status' => 'sometimes|required|integer',
        ]);

        $roomCategory->update($validated);

        return new RoomCategoryResource($roomCategory);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RoomCategory $roomCategory)
    {
        $roomCategory->delete();

        return response()->noContent();
    }
}
