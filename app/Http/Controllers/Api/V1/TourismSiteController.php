<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\TourismSite\CreateTourismSiteAction;
use App\Actions\TourismSite\ListTourismSitesAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\tourism_site\StoreTourismSiteRequest;
use App\Http\Requests\tourism_site\UpdateTourismSiteRequest;
use App\Models\TourismSite;
use App\Http\Resources\TourismSiteResource;


class TourismSiteController extends Controller
{

    private ListTourismSitesAction $listAction;
    private CreateTourismSiteAction $createAction;

    public function __construct(
        ListTourismSitesAction $listAction,
        CreateTourismSiteAction $createAction
    ) {
        $this->listAction = $listAction;
        $this->createAction = $createAction;
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->listAction->execute();
    }

    public function store(StoreTourismSiteRequest $request)
    {
        return $this->createAction->execute($request);
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
