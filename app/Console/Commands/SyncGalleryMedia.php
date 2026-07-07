<?php

namespace App\Console\Commands;

use App\Models\Club;
use App\Models\Media;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SyncGalleryMedia extends Command
{
    protected $signature = 'media:sync-gallery';

    protected $description = 'Scan storage/app/public/gallery and storage/app/public/players and register every image as Media so the API/photos page can serve it';

    public function handle(): int
    {
        $folders = ['gallery', 'players'];
        $total = 0;

        foreach (Club::query()->get() as $club) {
            foreach ($folders as $folder) {
                $directory = "{$folder}/{$club->slug}";

                if (! Storage::disk('public')->exists($directory)) {
                    continue;
                }

                foreach (Storage::disk('public')->files($directory) as $path) {
                    $title = Str::of(pathinfo($path, PATHINFO_FILENAME))->replace(['-', '_'], ' ')->title();

                    Media::query()->updateOrCreate(
                        [
                            'mediable_type' => 'club',
                            'mediable_id' => $club->id,
                            'url' => '/storage/'.$path,
                        ],
                        [
                            'type' => 'image',
                            'title' => $title,
                            'meta' => ['source' => $folder],
                        ]
                    );

                    $total++;
                }
            }
        }

        $this->info("Synced {$total} media files from gallery/players folders.");

        return self::SUCCESS;
    }
}
