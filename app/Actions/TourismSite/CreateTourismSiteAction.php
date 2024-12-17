<?php

namespace App\Actions\TourismSite;

use App\Http\Requests\tourism_site\StoreTourismSiteRequest;
use App\Models\TourismSite;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class CreateTourismSiteAction
{
    private CreateTourismSitePhotosAction $photosAction;

    public function __construct(CreateTourismSitePhotosAction $photosAction)
    {
        $this->photosAction = $photosAction;
    }

    /**
     * Crée un nouveau site touristique
     *
     * @param StoreTourismSiteRequest $request
     * @return JsonResponse
     */
    public function execute(StoreTourismSiteRequest $request): JsonResponse
    {

        if (!$request->hasFile('photos') || !is_array($request->file('photos')) || count($request->file('photos')) === 0) {
            return response()->json([
                'status_code' => 422,
                'status_message' => 'At least one photo is required to add a tourism site.',
            ], 422);
        }

        return DB::transaction(function () use ($request) {

            $tourismSite = TourismSite::create($request->validated());

            
            $mainPhotoIndex = $request->input('main_photo', 0);

           
            $this->photosAction->execute($tourismSite, $request->file('photos'), $mainPhotoIndex);

            
            $tourismSite->status = 1;
            $tourismSite->save();

            // Charger les photos associées pour les inclure dans la réponse
            $tourismSite->load('photos');

            return response()->json([
                'status_code' => 201,
                'status_message' => 'Tourism site created successfully',
                'data' => $tourismSite,
            ], 201);
        });
    }
}
