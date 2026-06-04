<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StandingEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'club_id', 'competition', 'category', 'season', 'position', 'team_name', 'played', 'wins', 'draws', 'losses', 'goals_for', 'goals_against', 'points', 'is_club',
    ];

    protected $casts = [
        'is_club' => 'boolean',
    ];

    public function club(): BelongsTo
    {
        return $this->belongsTo(Club::class);
    }
}
