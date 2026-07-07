<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClubMatch extends Model
{
    use HasFactory;

    protected $fillable = [
        'club_id', 'category', 'opponent', 'competition', 'match_date', 'match_time', 'day_label', 'venue', 'stadium', 'is_home', 'status', 'club_score', 'opponent_score',
    ];

    protected $casts = [
        'match_date' => 'date',
        'is_home' => 'boolean',
        'club_score' => 'integer',
        'opponent_score' => 'integer',
    ];

    public function club(): BelongsTo
    {
        return $this->belongsTo(Club::class);
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(MatchTicket::class);
    }
}
