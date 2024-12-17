<?php

namespace App\Actions\TourismSite;

use App\Http\Resources\TourismSiteResource;
use App\Models\TourismSite;

class ListTourismSitesAction
{
    /**
     * Execute the action.
     *
     * @param  array  $data
     * @return mixed
     */
    public function execute(int $perPage = 8)
    {
        $tourismSites = TourismSite::paginate($perPage);
        return TourismSiteResource::collection($tourismSites);
    }
}