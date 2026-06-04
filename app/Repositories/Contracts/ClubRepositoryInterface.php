<?php

namespace App\Repositories\Contracts;

use App\Models\Club;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface ClubRepositoryInterface
{
    public function paginateWithRelations(int $perPage = 15, array $relations = []): LengthAwarePaginator;

    public function findById(int $id, array $relations = []): ?Club;

    public function findBySlug(string $slug, array $relations = []): ?Club;

    public function create(array $data): Club;

    public function update(int $id, array $data): ?Club;

    public function delete(int $id): bool;

    public function getPlayersByCategory(string $clubSlug, string $category): Collection;
}
