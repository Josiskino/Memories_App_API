<?php

namespace App\Actions\TourismSite;

use App\Models\TourismSite;
use Illuminate\Support\Facades\Storage;

class CreateTourismSitePhotosAction
{
     /**
     * Gère l'upload et l'association des photos à un site touristique
     *
     * @param TourismSite $tourismSite
     * @param array $photos
     * @param int $mainPhotoIndex
     * @return void
     */
    public function execute(TourismSite $tourismSite, array $photos, int $mainPhotoIndex = 0)
    {
        foreach ($photos as $index => $photo) {
            $path = $photo->store('photos/tourism_site', 'public');
            $url = Storage::url($path);

            $tourismSite->photos()->create([
                'photoUrl' => $url,
                'is_main' => ($index == $mainPhotoIndex),
                'status' => 1, 
            ]);
        }
    }
}