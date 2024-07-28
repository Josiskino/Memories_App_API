<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TourismSiteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'tourismeSiteName' => $this->tourismeSiteName,
            'tourismeSiteCity' => $this->tourismeSiteCity,
            'tourismeSiteDescription' => $this->tourismeSiteDescription,
            'tourismeSiteEnterPrice' => $this->tourismeSiteEnterPrice,
            'tourismeSiteWebSite' => $this->tourismeSiteWebSite,
            'tourismeSitePhoneNumber' => $this->tourismeSitePhoneNumber,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'status' => $this->status,
            // 'created_at' => $this->created_at,
            // 'updated_at' => $this->updated_at,
            'photos' => PhotoResource::collection($this->photos),
        ];
    }
}
