<?php

namespace App\Repositories\Contracts;

use App\Models\StandingEntry;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface StandingEntryRepositoryInterface
{
    public function paginate(int $perPage = 15): LengthAwarePaginator;
    public function findById(int $id): ?StandingEntry;
    public function create(array $data): StandingEntry;
    public function update(int $id, array $data): ?StandingEntry;
    public function delete(int $id): bool;
    public function forClub(string $clubSlug): Collection;
}
