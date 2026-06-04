<?php

namespace App\Repositories\Eloquent;

use App\Models\Player;
use App\Repositories\Contracts\PlayerRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EloquentPlayerRepository implements PlayerRepositoryInterface
{
    public function search(array $filters = [], int $perPage = 15, array $relations = []): LengthAwarePaginator
    {
        return Player::query()
            ->with($relations)
            ->when(isset($filters['team_id']), function ($query) use ($filters): void {
                $query->where('team_id', $filters['team_id']);
            })
            ->when(isset($filters['club_slug']), function ($query) use ($filters): void {
                $query->whereHas('team.club', function ($clubQuery) use ($filters): void {
                    $clubQuery->where('slug', $filters['club_slug']);
                });
            })
            ->orderBy('number')
            ->paginate($perPage);
    }

    public function findById(int $id, array $relations = []): ?Player
    {
        return Player::query()->with($relations)->find($id);
    }

    public function create(array $data): Player
    {
        return Player::query()->create($data);
    }

    public function update(int $id, array $data): ?Player
    {
        $player = Player::query()->find($id);

        if (! $player) {
            return null;
        }

        $player->update($data);

        return $player->refresh();
    }

    public function delete(int $id): bool
    {
        $player = Player::query()->find($id);

        if (! $player) {
            return false;
        }

        return (bool) $player->delete();
    }
}
