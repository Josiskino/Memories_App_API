<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\TourismSite;
use App\Http\Requests\StoreTourismSiteRequest;
use App\Http\Requests\UpdateTourismSiteRequest;
use Illuminate\Http\Request;

class TourismSiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTourismSiteRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(TourismSite $tourismSite)
    {
        //
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
