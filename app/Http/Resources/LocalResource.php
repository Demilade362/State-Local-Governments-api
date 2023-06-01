<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LocalResource extends JsonResource
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
            'localGovernmentArea' => $this->name,
            'state' => [
                $this->mergeWhen($this->state, [
                    'stateName' => $this->state->pluck('name'),
                    'governor' => $this->state->pluck('governor_name'),
                ])
            ],
            'attributes' => [
                'AddedAt' => $this->created_at->diffForHumans(),
                'updatedAt' => $this->updated_at->diffForHumans()
            ]
        ];
    }
}
