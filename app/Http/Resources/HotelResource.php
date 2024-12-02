<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HotelResource extends JsonResource
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
            'hotelName' => $this->hotelName,
            'hotelCity' => $this->hotelCity,
            'hotelEmail' => $this->hotelEmail,
            'hotelPhone' => $this->hotelPhone,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'photos' => HotelPhotoResource::collection($this->whenLoaded('photos')),
        ];
    }
}
