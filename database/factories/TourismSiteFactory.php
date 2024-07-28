<?php

namespace Database\Factories;

use App\Models\TourismSite;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TourismSite>
 */
class TourismSiteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tourismeSiteName' => $this->faker->company,
            'tourismeSiteCity' => $this->faker->city,
            'tourismeSiteDescription' => $this->faker->paragraph,
            'tourismeSiteEnterPrice' => $this->faker->randomFloat(2, 10, 100),
            'tourismeSiteWebSite' => $this->faker->url,
            'tourismeSitePhoneNumber' => $this->faker->phoneNumber,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'status' => $this->faker->numberBetween(0, 1),
        ];
    }
}
