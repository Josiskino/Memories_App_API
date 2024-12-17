<?php

namespace App\Actions\CategoryTourismSite;

use App\Models\TourismCategory;

class CreateTourismSiteCategory
{
    /**
     * Handle the creation of a tourism category.
     *
     * @param array $validatedData
     * @return TourismCategory
     */

     public function execute(array $validatedData): TourismCategory
     {
         return TourismCategory::create($validatedData);
     }
}