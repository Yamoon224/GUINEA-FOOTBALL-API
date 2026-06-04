<?php

namespace App\Repositories\Eloquent;

use App\Models\Club;
use App\Repositories\Contracts\ClubRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class EloquentClubRepository implements ClubRepositoryInterface
{
    public function paginateWithRelations(int $perPage = 15, array $relations = []): LengthAwarePaginator
    {
        return Club::query()
            ->with($relations)
            ->latest('id')
            ->paginate($perPage);
    }

    public function findById(int $id, array $relations = []): ?Club
    {
        return Club::query()
            ->with($relations)
            ->find($id);
    }

    public function findBySlug(string $slug, array $relations = []): ?Club
    {
        return Club::query()
            ->with($relations)
            ->where('slug', $slug)
            ->first();
    }

    public function create(array $data): Club
    {
        return Club::query()->create($data);
    }

    public function update(int $id, array $data): ?Club
    {
        $club = Club::query()->find($id);

        if (! $club) {
            return null;
        }

        $club->update($data);

        return $club->refresh();
    }

    public function delete(int $id): bool
    {
        $club = Club::query()->find($id);

        if (! $club) {
            return false;
        }

        return (bool) $club->delete();
    }

    public function getPlayersByCategory(string $clubSlug, string $category): Collection
    {
        $club = Club::query()->where('slug', $clubSlug)->first();

        if (! $club) {
            return collect();
        }

        $team = $club->teams()->where('category', ucfirst($category))->first();

        if (! $team) {
            return collect();
        }

        return $team->players()->with('media')->orderBy('number')->get();
    }
}
