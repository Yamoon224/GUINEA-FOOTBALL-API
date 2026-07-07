<?php

namespace App\Repositories\Eloquent;

use App\Models\MatchTicket;
use App\Repositories\Contracts\MatchTicketRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class EloquentMatchTicketRepository implements MatchTicketRepositoryInterface
{
    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return MatchTicket::query()->with('match')->paginate($perPage);
    }

    public function findById(int $id): ?MatchTicket
    {
        return MatchTicket::query()->find($id);
    }

    public function create(array $data): MatchTicket
    {
        return MatchTicket::query()->create($data);
    }

    public function update(int $id, array $data): ?MatchTicket
    {
        $item = MatchTicket::query()->find($id);
        if (! $item) {
            return null;
        }
        $item->update($data);
        return $item->refresh();
    }

    public function delete(int $id): bool
    {
        return (bool) MatchTicket::query()->whereKey($id)->delete();
    }

    public function forClub(string $clubSlug): Collection
    {
        return MatchTicket::query()
            ->with('match')
            ->whereHas('match', fn ($query) => $query->whereHas('club', fn ($q) => $q->where('slug', $clubSlug)))
            ->get()
            ->groupBy('club_match_id');
    }
}
