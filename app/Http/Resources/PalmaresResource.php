<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PalmaresResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'club_id' => $this->club_id,
            'competition' => $this->competition,
            'annee' => $this->year,
            'rang' => $this->rank,
            'description' => $this->description,
        ];
    }
}
