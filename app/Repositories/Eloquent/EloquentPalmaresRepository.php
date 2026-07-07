<?php

namespace App\Repositories\Eloquent;

use App\Models\Palmares;
use App\Repositories\Contracts\PalmaresRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class EloquentPalmaresRepository implements PalmaresRepositoryInterface
{
    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return Palmares::query()->orderByDesc('year')->paginate($perPage);
    }

    public function findById(int $id): ?Palmares
    {
        return Palmares::query()->find($id);
    }

    public function create(array $data): Palmares
    {
        return Palmares::query()->create($data);
    }

    public function update(int $id, array $data): ?Palmares
    {
        $item = Palmares::query()->find($id);
        if (! $item) {
            return null;
        }
        $item->update($data);
        return $item->refresh();
    }

    public function delete(int $id): bool
    {
        return (bool) Palmares::query()->whereKey($id)->delete();
    }

    public function forClub(string $clubSlug): Collection
    {
        return Palmares::query()
            ->whereHas('club', fn ($query) => $query->where('slug', $clubSlug))
            ->orderByDesc('year')
            ->get();
    }
}
