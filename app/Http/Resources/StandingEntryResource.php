<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StandingEntryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'position' => $this->position,
            'equipe' => $this->team_name,
            'joues' => $this->played,
            'victoires' => $this->wins,
            'nuls' => $this->draws,
            'defaites' => $this->losses,
            'butsPour' => $this->goals_for,
            'butsContre' => $this->goals_against,
            'gd' => is_null($this->goals_for) || is_null($this->goals_against) ? null : $this->goals_for - $this->goals_against,
            'points' => $this->points,
            'isClub' => $this->is_club,
        ];
    }
}
