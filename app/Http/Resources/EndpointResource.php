<?php

namespace App\Http\Resources;

use App\Enums\EndpointFrequency;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EndpointResource extends JsonResource
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
            'location' => $this->location,
            'frequency_label' => EndpointFrequency::from($this->frequency)->label(),
            'frequency_value' => EndpointFrequency::from($this->frequency)->value,
        ];
    }
}
