<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\TourismSite;
use Illuminate\Database\Seeder;

class TourismSiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TourismSite::factory()->count(50)->create();
    }
}
