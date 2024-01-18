<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PersonResource extends JsonResource
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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->whenHas('email'),
            'phone' => $this->whenHas('phone'),
            'document' => $this->whenHas('document'),
            'gender' => $this->whenHas('gender'),
            'image' => $this->whenHas('image'),
            'role' => $this->whenLoaded('role'),
            'district' => new DistrictResource($this->whenLoaded('district')),
        ];
    }
}
