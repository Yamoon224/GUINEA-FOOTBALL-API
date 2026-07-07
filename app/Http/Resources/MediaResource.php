<?php

namespace App\Http\Resources;

use App\Support\AssetUrl;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MediaResource extends JsonResource
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
            'type' => $this->type,
            'title' => $this->title,
            'url' => AssetUrl::resolve($this->url),
            'meta' => $this->meta,
            'mediable_type' => $this->mediable_type,
            'mediable_id' => $this->mediable_id,
            'created_at' => $this->created_at,
        ];
    }
}
