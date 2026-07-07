<?php

namespace App\Repositories\Contracts;

use App\Models\Palmares;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface PalmaresRepositoryInterface
{
    public function paginate(int $perPage = 15): LengthAwarePaginator;
    public function findById(int $id): ?Palmares;
    public function create(array $data): Palmares;
    public function update(int $id, array $data): ?Palmares;
    public function delete(int $id): bool;
    public function forClub(string $clubSlug): Collection;
}
