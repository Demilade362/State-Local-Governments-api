<?php

namespace App\Http\Resources;

use App\Models\Local;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (string) $this->id,
            'stateName' => $this->name,
            'governor' => $this->governor_name,
            'deputyGovernor' => $this->deputy_governor_name,
            'population' => $this->population,
            'localGovernments' => (string) $this->whenCounted('local'),
            'attributes' => [
                'localGovernmentArea' => $this->local->pluck('name')->implode(', '),
            ]
        ];
    }
}
