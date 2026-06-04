<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeamResource extends JsonResource
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
            'club_id' => $this->club_id,
            'name' => $this->name,
            'category' => $this->category,
            'coach' => $this->coach,
            'players' => PlayerResource::collection($this->whenLoaded('players')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
