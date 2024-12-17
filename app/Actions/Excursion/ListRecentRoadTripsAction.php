<?php

namespace App\Actions\Excursion;

use App\Http\Resources\ExcursionResource;
use App\Models\Excursion;

class ListRecentRoadTripsAction
{
    /**
     * Execute the action.
     *
     * @param  array  $data
     * @return mixed
     */
    public function execute($limit = 3)
    {
        $recentRoadTrips = Excursion::latest()->limit($limit)->get();
        return ExcursionResource::collection($recentRoadTrips);
    }
}