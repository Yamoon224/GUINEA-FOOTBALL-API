<?php

namespace App\Repositories\Contracts;

use App\Models\NewsArticle;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface NewsArticleRepositoryInterface
{
    public function paginate(int $perPage = 15): LengthAwarePaginator;
    public function findById(int $id): ?NewsArticle;
    public function create(array $data): NewsArticle;
    public function update(int $id, array $data): ?NewsArticle;
    public function delete(int $id): bool;
    public function forClub(string $clubSlug): Collection;
}
