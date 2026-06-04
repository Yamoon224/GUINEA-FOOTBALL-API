<?php

namespace App\Repositories\Eloquent;

use App\Contracts\MediaAttachable;
use App\Models\Media;
use App\Repositories\Contracts\MediaRepositoryInterface;
use Illuminate\Support\Collection;

class EloquentMediaRepository implements MediaRepositoryInterface
{
    public function attachTo(MediaAttachable $entity, array $data): Media
    {
        return $entity->media()->create($data);
    }

    public function getForEntity(MediaAttachable $entity): Collection
    {
        return $entity->media()->latest('id')->get();
    }

    public function findById(int $id): ?Media
    {
        return Media::query()->find($id);
    }

    public function delete(int $id): bool
    {
        $media = Media::query()->find($id);

        if (! $media) {
            return false;
        }

        return (bool) $media->delete();
    }
}
