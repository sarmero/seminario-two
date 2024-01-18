<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdmissionResource extends JsonResource
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
            'date' => $this->whenHas('date'),
            'person' => new PersonResource($this->whenLoaded('person')),
            'state' => $this->whenLoaded('state'),
            'offer' => new ProgramOfferResource($this->whenLoaded('offer')),
        ];
    }
}
