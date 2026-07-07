<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MatchTicket extends Model
{
    use HasFactory;

    protected $fillable = [
        'club_match_id',
        'type',
        'price',
        'available',
        'total',
    ];

    protected $casts = [
        'available' => 'integer',
        'total' => 'integer',
    ];

    public function match(): BelongsTo
    {
        return $this->belongsTo(ClubMatch::class, 'club_match_id');
    }
}
