<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\CategoryTourismSite\ListCategoryTourismSiteAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Actions\TourismSite\ListRecentTourismSitesAction;
use App\Actions\Excursion\ListRecentRoadTripsAction;
use Illuminate\Http\JsonResponse;

class HomeController extends Controller
{
    private ListCategoryTourismSiteAction $categoriesAction;
    private ListRecentTourismSitesAction $tourismSitesAction;
    private ListRecentRoadTripsAction $roadTripsAction;

    public function __construct(
        ListCategoryTourismSiteAction $categoriesAction,
        ListRecentTourismSitesAction $tourismSitesAction,
        ListRecentRoadTripsAction $roadTripsAction
    ) {
        $this->categoriesAction = $categoriesAction;
        $this->tourismSitesAction = $tourismSitesAction;
        $this->roadTripsAction = $roadTripsAction;
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'categories' => $this->categoriesAction->execute(),
            'recent_sites' => $this->tourismSitesAction->execute(),
            'recent_road_trips' => $this->roadTripsAction->execute(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
