<?php

namespace App\Repositories\Eloquent;

use App\Models\StandingEntry;
use App\Repositories\Contracts\StandingEntryRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class EloquentStandingEntryRepository implements StandingEntryRepositoryInterface
{
    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return StandingEntry::query()->orderBy('position')->paginate($perPage);
    }

    public function findById(int $id): ?StandingEntry
    {
        return StandingEntry::query()->find($id);
    }

    public function create(array $data): StandingEntry
    {
        return StandingEntry::query()->create($data);
    }

    public function update(int $id, array $data): ?StandingEntry
    {
        $item = StandingEntry::query()->find($id);
        if (! $item) {
            return null;
        }
        $item->update($data);
        return $item->refresh();
    }

    public function delete(int $id): bool
    {
        return (bool) StandingEntry::query()->whereKey($id)->delete();
    }

    public function forClub(string $clubSlug): Collection
    {
        return StandingEntry::query()
            ->whereHas('club', fn ($query) => $query->where('slug', $clubSlug))
            ->orderBy('competition')
            ->orderBy('category')
            ->orderBy('position')
            ->get();
    }
}
