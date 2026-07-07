<?php

namespace App\Repositories\Contracts;

use App\Models\MatchTicket;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface MatchTicketRepositoryInterface
{
    public function paginate(int $perPage = 15): LengthAwarePaginator;
    public function findById(int $id): ?MatchTicket;
    public function create(array $data): MatchTicket;
    public function update(int $id, array $data): ?MatchTicket;
    public function delete(int $id): bool;
    public function forClub(string $clubSlug): Collection;
}
