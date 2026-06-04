<?php

namespace App\Models;

use App\Contracts\MediaAttachable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Club extends Model implements MediaAttachable
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'name',
        'acronym',
        'founded_at',
        'city',
        'description',
        'logo',
        'hero',
        'primary_color',
        'secondary_color',
        'social',
    ];

    protected $casts = [
        'founded_at' => 'date',
        'social' => 'array',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function teams(): HasMany
    {
        return $this->hasMany(Team::class);
    }

    public function media(): MorphMany
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    public function newsArticles(): HasMany
    {
        return $this->hasMany(NewsArticle::class);
    }

    public function matches(): HasMany
    {
        return $this->hasMany(ClubMatch::class);
    }

    public function standings(): HasMany
    {
        return $this->hasMany(StandingEntry::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(ShopProduct::class);
    }
}
