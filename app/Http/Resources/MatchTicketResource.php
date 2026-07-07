<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MatchTicketResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'club_match_id' => $this->club_match_id,
            'type' => $this->type,
            'price' => $this->price,
            'available' => $this->available,
            'total' => $this->total,
        ];
    }
}
