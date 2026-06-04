<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClubResource extends JsonResource
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
            'slug' => $this->slug,
            'name' => $this->name,
            'acronym' => $this->acronym,
            'founded_at' => $this->founded_at,
            'city' => $this->city,
            'description' => $this->description,
            'logo' => $this->logo,
            'hero' => $this->hero,
            'primary_color' => $this->primary_color,
            'secondary_color' => $this->secondary_color,
            'social' => $this->social,
            'teams' => TeamResource::collection($this->whenLoaded('teams')),
            'media' => MediaResource::collection($this->whenLoaded('media')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
