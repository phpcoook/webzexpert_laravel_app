<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RealEstatePropertyResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'real_estate_type' => $this->real_estate_type,
            'street' => $this->street,
            'external_number' => $this->external_number,
            'internal_number' => $this->internal_number,
            'neighborhood' => $this->neighborhood,
            'city' => $this->city,
            'country' => $this->country,
            'rooms' => $this->rooms,
            'bathrooms' => $this->bathrooms,
            'comments' => $this->comments,
            'created_at' => $this->created_at,
        ];
    }
}

