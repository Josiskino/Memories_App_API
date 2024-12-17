<?php

namespace App\Actions\TourismSite;

use App\Http\Resources\TourismSiteResource;
use App\Models\TourismSite;

class ListRecentTourismSitesAction
{
    /**
     * Execute the action.
     *
     * @param  array  $data
     * @return mixed
     */
    public function execute($limit = 3)
    {
        $recentSites = TourismSite::latest()->limit($limit)->get();
        return TourismSiteResource::collection($recentSites);
    }
}