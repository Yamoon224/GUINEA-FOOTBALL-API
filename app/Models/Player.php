<?php

namespace App\Models;

use App\Contracts\MediaAttachable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Player extends Model implements MediaAttachable
{
    use HasFactory;

    protected $fillable = [
        'team_id',
        'number',
        'first_name',
        'last_name',
        'date_of_birth',
        'position',
        'height',
        'photo',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function media(): MorphMany
    {
        return $this->morphMany(Media::class, 'mediable');
    }
}
