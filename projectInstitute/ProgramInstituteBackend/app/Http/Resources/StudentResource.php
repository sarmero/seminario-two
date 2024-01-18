<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
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
            'code' => $this->code,
            'person' => new PersonResource($this->whenLoaded('person')),
            'semester' => $this->whenLoaded('semester'),
            'offer' => new ProgramOfferResource($this->whenLoaded('offer')),
        ];
    }
}
