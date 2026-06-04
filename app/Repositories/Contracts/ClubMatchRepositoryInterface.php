<?php

namespace App\Repositories\Contracts;

use App\Models\ClubMatch;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface ClubMatchRepositoryInterface
{
    public function paginate(int $perPage = 15): LengthAwarePaginator;
    public function findById(int $id): ?ClubMatch;
    public function create(array $data): ClubMatch;
    public function update(int $id, array $data): ?ClubMatch;
    public function delete(int $id): bool;
    public function upcomingForClub(string $clubSlug): Collection;
    public function resultsForClub(string $clubSlug): Collection;
}
