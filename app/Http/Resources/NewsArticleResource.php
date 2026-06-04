<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NewsArticleResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'titre' => $this->title,
            'contenu' => $this->content,
            'image' => $this->image,
            'datePublication' => optional($this->published_at)->toDateString(),
            'categorie' => $this->category,
        ];
    }
}
