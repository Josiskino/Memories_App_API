<?php

namespace App\Actions\CategoryTourismSite;

use App\Models\TourismCategory;

class ListCategoryTourismSiteAction
{
    /**
     * Handle the retrieval of tourism categories.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function execute()
    {
        return TourismCategory::all();
    }
}
