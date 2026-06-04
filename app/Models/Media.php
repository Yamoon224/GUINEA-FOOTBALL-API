<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Media extends Model
{
    use HasFactory;

    protected $table = 'media';

    protected $fillable = [
        'mediable_type',
        'mediable_id',
        'type',
        'title',
        'url',
        'meta',
    ];

    protected $casts = [
        'meta' => 'array',
    ];

    public function mediable(): MorphTo
    {
        return $this->morphTo();
    }
}
