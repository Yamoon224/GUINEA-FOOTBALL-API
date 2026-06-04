<?php

namespace App\Repositories\Contracts;

use App\Contracts\MediaAttachable;
use App\Models\Media;
use Illuminate\Support\Collection;

interface MediaRepositoryInterface
{
    public function attachTo(MediaAttachable $entity, array $data): Media;

    public function getForEntity(MediaAttachable $entity): Collection;

    public function findById(int $id): ?Media;

    public function delete(int $id): bool;
}
