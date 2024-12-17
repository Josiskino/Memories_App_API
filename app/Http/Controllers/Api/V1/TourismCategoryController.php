<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\tourism_category\StoreTourismCategoryRequest;
use App\Http\Requests\tourism_category\UpdateTourismCategoryRequest;
use App\Models\TourismCategory;
use App\Actions\CategoryTourismSite\CreateTourismSiteCategory;
use App\Actions\CategoryTourismSite\ListCategoryTourismSiteAction;
use App\Http\Resources\TourismSiteCategoryResource;


class TourismCategoryController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @param ListCategoryTourismSiteAction $listCategoryAction
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(ListCategoryTourismSiteAction $listCategoryAction)
    {
        $categories = $listCategoryAction->execute();

        return response()->json([
            'success' => true,
            'data' => TourismSiteCategoryResource::collection($categories),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTourismCategoryRequest $request
     * @param CreateTourismSiteCategory $createTourismSiteCategory
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreTourismCategoryRequest $request, CreateTourismSiteCategory $createTourismSiteCategory)
    {
        $category = $createTourismSiteCategory->execute($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Category created successfully.',
            'data' => new TourismSiteCategoryResource($category),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(TourismCategory $tourismCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TourismCategory $tourismCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTourismCategoryRequest $request, TourismCategory $tourismCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TourismCategory $tourismCategory)
    {
        //
    }
}
