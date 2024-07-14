<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AgencyResource extends JsonResource
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
            'user_id' => $this->user_id,
            'agencyName' => $this->agencyName,
            'agencyResponsibleName' => $this->agencyResponsibleName,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
           
        ];
    }
}
