<?php

namespace App\Repositories\Contracts;

use App\Models\Player;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface PlayerRepositoryInterface
{
    public function search(array $filters = [], int $perPage = 15, array $relations = []): LengthAwarePaginator;

    public function findById(int $id, array $relations = []): ?Player;

    public function create(array $data): Player;

    public function update(int $id, array $data): ?Player;

    public function delete(int $id): bool;
}
