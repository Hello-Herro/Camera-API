<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CameraResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'brand' => $this->brand,
            'sensor_type' => $this->sensor_type,
            'resolution' => $this->resolution . ' MP',
            'price' => 'Rp ' . number_format($this->price, 0, ',', '.'),
        ];
    }
}
