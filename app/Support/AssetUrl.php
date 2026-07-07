<?php

namespace App\Support;

class AssetUrl
{
    /**
     * Resolve a possibly-relative storage path into an absolute URL.
     * Leaves already-absolute URLs untouched so external links keep working.
     */
    public static function resolve(?string $path): ?string
    {
        if (! $path) {
            return $path;
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        return rtrim(config('app.url'), '/').'/'.ltrim($path, '/');
    }
}
