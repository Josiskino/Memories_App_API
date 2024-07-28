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
            'user' => new UserResource($this->user),
            'agencyName' => $this->agencyName,
            'agencyResponsibleName' => $this->agencyResponsibleName,
            'agencyAttestation' => $this->agencyAttestation,
            'agencyAddress' => $this->agencyAddress,
            'agencyPhone' => $this->agencyPhone,
            'agencyLogo' => $this->agencyLogo,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
           
        ];
    }
}
