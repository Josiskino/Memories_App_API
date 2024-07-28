<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use App\Http\Requests\StorePhotoRequest;
use App\Http\Requests\UpdatePhotoRequest;
use App\Http\Resources\PhotoResource;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $photos = Photo::all();
        return PhotoResource::collection($photos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePhotoRequest $request)
    {
        $validated = $request->validate([
            'photoUrl' => 'required|string|max:255',
            'photoable_type' => 'required|string|max:255',
            'photoable_id' => 'required|integer',
            'status' => 'required|integer',
        ]);

        $photo = Photo::create($validated);

        return new PhotoResource($photo);
    }

    /**
     * Display the specified resource.
     */
    public function show(Photo $photo)
    {
        return new PhotoResource($photo);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePhotoRequest $request, Photo $photo)
    {
        $validated = $request->validate([
            'photoUrl' => 'sometimes|required|string|max:255',
            'photoable_type' => 'sometimes|required|string|max:255',
            'photoable_id' => 'sometimes|required|integer',
            'status' => 'sometimes|required|integer',
        ]);

        $photo->update($validated);

        return new PhotoResource($photo);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Photo $photo)
    {
        $photo->delete();

        return response()->noContent();
    }
}
