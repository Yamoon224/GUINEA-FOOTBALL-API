<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClubMatchResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'date' => optional($this->match_date)->toDateString(),
            'heure' => $this->match_time,
            'journee' => $this->day_label,
            'adversaire' => $this->opponent,
            'competition' => $this->competition,
            'lieu' => $this->is_home ? 'Domicile' : 'Extérieur',
            'stade' => $this->stadium,
            'categorie' => $this->category,
            'status' => $this->status,
            'scoreClub' => $this->club_score,
            'scoreAdv' => $this->opponent_score,
        ];
    }
}
