<?php

namespace App\Repositories\Eloquent;

use App\Models\ClubMatch;
use App\Repositories\Contracts\ClubMatchRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class EloquentClubMatchRepository implements ClubMatchRepositoryInterface
{
    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return ClubMatch::query()->latest('match_date')->paginate($perPage);
    }

    public function findById(int $id): ?ClubMatch
    {
        return ClubMatch::query()->find($id);
    }

    public function create(array $data): ClubMatch
    {
        return ClubMatch::query()->create($data);
    }

    public function update(int $id, array $data): ?ClubMatch
    {
        $item = ClubMatch::query()->find($id);
        if (! $item) {
            return null;
        }
        $item->update($data);
        return $item->refresh();
    }

    public function delete(int $id): bool
    {
        return (bool) ClubMatch::query()->whereKey($id)->delete();
    }

    public function upcomingForClub(string $clubSlug): Collection
    {
        return ClubMatch::query()
            ->whereHas('club', fn ($query) => $query->where('slug', $clubSlug))
            ->where('status', 'scheduled')
            ->orderBy('match_date')
            ->get();
    }

    public function resultsForClub(string $clubSlug): Collection
    {
        return ClubMatch::query()
            ->whereHas('club', fn ($query) => $query->where('slug', $clubSlug))
            ->where('status', 'completed')
            ->orderByDesc('match_date')
            ->get();
    }
}
