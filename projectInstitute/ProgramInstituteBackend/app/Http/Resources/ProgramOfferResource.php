<?php

namespace App\Http\Resources;

use App\Http\Resources\ProgramResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProgramOfferResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'quotas' => $this->whenHas('quotas'),
            'code' => $this->whenHas('code'),
            'program' => new ProgramResource($this->whenLoaded('program')),
            'admission' => AdmissionResource::collection($this->whenLoaded('admission')),
            'modality' => $this->whenLoaded('modality'),
            'state' => new StateOfferResource($this->whenLoaded('stateOffer')),
            'calendar' => $this->whenLoaded('calendar'),
        ];
    }
}
