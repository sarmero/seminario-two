<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RatingsResource extends JsonResource
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
            'offer' => new SubjectOfferResource($this->whenLoaded('offerSubject')),
            'student'=> new StudentResource($this->whenLoaded('student')),
            'note' => $this->whenHas('note'),
        ];
    }
}
