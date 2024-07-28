<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExcursionResource extends JsonResource
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
            'excursionName' => $this->excursionName,
            'excursionDescription' => $this->excursionDescription,
            'excursionDate' => $this->excursionDate,
            'excursionTime' => $this->excursionTime,
            'excursionPlace' => $this->excursionPlace,
            'excursionPrice' => $this->excursionPrice,
            'excursionMaxParticipants' => $this->excursionMaxParticipants,
            'status' => $this->status,
            'agency' => new AgencyResource($this->whenLoaded('agency')),
            'tourism_site_id' => $this->tourism_site_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
