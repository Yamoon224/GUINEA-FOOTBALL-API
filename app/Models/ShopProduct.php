<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShopProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'club_id', 'slug', 'name_fr', 'name_en', 'category', 'price', 'image', 'is_new', 'is_sale', 'old_price', 'rating', 'reviews', 'is_active',
    ];

    protected $casts = [
        'is_new' => 'boolean',
        'is_sale' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function club(): BelongsTo
    {
        return $this->belongsTo(Club::class);
    }
}
