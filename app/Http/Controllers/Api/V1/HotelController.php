<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Http\Resources\HotelResource;
use App\Http\Requests\StoreHotelRequest;
use App\Http\Requests\UpdateHotelRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\JsonResponse;

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
    public function store(StoreHotelRequest $request): JsonResponse
    {
        try {
            // Valider les données de la requête
            $validatedData = $request->validated();

            // Vérifier s'il y a des photos dans la requête
            if (!$request->hasFile('photos') || !is_array($request->file('photos')) || count($request->file('photos')) === 0) {
                return response()->json([
                    'status_code' => 422,
                    'status_message' => 'At least one photo is required to add a hotel.',
                ], 422);
            }

            // Créer l'hôtel
            $hotel = Hotel::create($validatedData);

            // Récupérer l'indice de la photo principale
            $mainPhotoIndex = $request->input('main_photo', 0); // Par défaut, on prend la première photo

            // Gérer le téléchargement et l'enregistrement des photos
            $photos = $request->file('photos');
            foreach ($photos as $index => $photo) {
                // Téléchargement et stockage de la photo
                $path = $photo->store('photos', 'public');
                $url = Storage::url($path);

                // Créer l'entrée photo associée à l'hôtel
                $hotel->photos()->create([
                    'hotelPhotoUrl' => $url,
                    'is_main' => $index == $mainPhotoIndex ? 1 : 0, // Mettre à 1 seulement pour la photo principale
                    'status' => 1, // La photo est active par défaut
                ]);
            }

            // Charger les photos associées pour les inclure dans la réponse
            $hotel->load('photos');

            return response()->json([
                'status_code' => 201,
                'status_message' => 'Hotel created successfully',
                'data' => new HotelResource($hotel),
            ], 201);
        } catch (\Exception $e) {
            Log::error('Error creating hotel', ['exception' => $e->getMessage()]);

            return response()->json([
                'status_code' => 500,
                'status_message' => 'An error occurred while creating the hotel',
                'error' => $e->getMessage(),
            ], 500);
        }
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
