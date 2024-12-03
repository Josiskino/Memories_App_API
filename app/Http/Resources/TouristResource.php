<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TouristResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            //'user_id' => $this->user_id,
            'id' => $this->id,
            'email' => $this->user->email,
            'role' => $this->user->role,
            'touristName' => $this->touristName,
            'touristPhone' => $this->touristPhone,
            //'touristUserName' => $this->touristUserName,
            // 'touristAddress' => $this->touristAddress,
            // 'touristCity' => $this->touristCity,
            // 'touristCountry' => $this->touristCountry,
            // 'touristPostalCode' => $this->touristPostalCode,
            // 'touristPassport' => $this->touristPassport,
            // 'touristPassportCountry' => $this->touristPassportCountry,
            // 'touristPassportDate' => $this->touristPassportDate,
            // 'touristPassportNumber' => $this->touristPassportNumber,
            // 'touristPassportExpiry' => $this->touristPassportExpiry,
            // 'touristPassportIssue' => $this->touristPassportIssue,
            // 'touristPassportPlace' => $this->touristPassportPlace,
            // 'touristPassportType' => $this->touristPassportType,
            // 'touristPassportImage' => $this->touristPassportImage
            //     ? url('storage/' . $this->touristPassportImage)
            //     : null, // Chemin complet de l'image si elle existe
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
