<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\TourismSite;
use App\Http\Requests\StoreTourismSiteRequest;
use App\Http\Requests\UpdateTourismSiteRequest;
use App\Http\Resources\TourismSiteResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class TourismSiteController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tourismSites = TourismSite::paginate(8);
        return TourismSiteResource::collection($tourismSites);
    }

    
    public function store(StoreTourismSiteRequest $request): JsonResponse
    {
        // Créer le site touristique
        $tourismSite = TourismSite::create($request->validated());

        // Vérifier s'il y a des photos dans la requête
        if (!$request->hasFile('photos') || !is_array($request->file('photos')) || count($request->file('photos')) === 0) {
            return response()->json([
                'status_code' => 422,
                'status_message' => 'At least one photo is required to add a tourism site.',
            ], 422);
        }

        // Récupérer l'indice de la photo principale
        $mainPhotoIndex = $request->input('main_photo', 0); // Par défaut, on prend la première photo

        $photos = $request->file('photos');
        foreach ($photos as $index => $photo) {
            // Téléchargement et stockage de la photo
            $path = $photo->store('photos', 'public');
            $url = Storage::url($path);

            // Créer l'entrée photo associée au site touristique
            $tourismSite->photos()->create([
                'photoUrl' => $url,
                'is_main' => ($index == $mainPhotoIndex),
                'status' => 1, // La photo est active par défaut
            ]);
        }

        // Mettre à jour le statut du site touristique à 1 (publié)
        $tourismSite->status = 1;
        $tourismSite->save();

        // Charger les photos associées pour les inclure dans la réponse
        $tourismSite->load('photos');

        return response()->json([
            'status_code' => 201,
            'status_message' => 'Tourism site created successfully',
            'data' => $tourismSite,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(TourismSite $tourismSite)
    {
        return new TourismSiteResource($tourismSite);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTourismSiteRequest $request, TourismSite $tourismSite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TourismSite $tourismSite)
    {
        //
    }
}
