<?php

namespace App\Repositories\Eloquent;

use App\Models\NewsArticle;
use App\Repositories\Contracts\NewsArticleRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class EloquentNewsArticleRepository implements NewsArticleRepositoryInterface
{
    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return NewsArticle::query()->latest('published_at')->paginate($perPage);
    }

    public function findById(int $id): ?NewsArticle
    {
        return NewsArticle::query()->find($id);
    }

    public function create(array $data): NewsArticle
    {
        return NewsArticle::query()->create($data);
    }

    public function update(int $id, array $data): ?NewsArticle
    {
        $item = NewsArticle::query()->find($id);
        if (! $item) {
            return null;
        }
        $item->update($data);
        return $item->refresh();
    }

    public function delete(int $id): bool
    {
        return (bool) NewsArticle::query()->whereKey($id)->delete();
    }

    public function forClub(string $clubSlug): Collection
    {
        return NewsArticle::query()
            ->whereHas('club', fn ($query) => $query->where('slug', $clubSlug))
            ->where('is_published', true)
            ->latest('published_at')
            ->get();
    }
}
