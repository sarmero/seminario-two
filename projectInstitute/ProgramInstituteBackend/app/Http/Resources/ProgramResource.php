<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProgramResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->whenHas('description'),
            'image' => $this->whenHas('image'),
            'subject' => SubjectResource::collection($this->whenLoaded('subject')),
            'offer'=> ProgramOfferResource::collection($this->whenLoaded('offer')),
        ];
    }
}
