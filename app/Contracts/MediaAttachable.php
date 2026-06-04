<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphMany;

interface MediaAttachable
{
    public function media(): MorphMany;
}
