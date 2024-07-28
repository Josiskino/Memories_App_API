<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
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
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
            'reservable_type' => $this->reservable_type,
            'reservable_id' => $this->reservable_id,
            //changer le tourist id par ces informations (class tourist)
            'tourist_id' => $this->tourist_id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
