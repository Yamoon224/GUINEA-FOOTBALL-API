<?php

namespace App\Repositories\Contracts;

use App\Models\ShopProduct;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface ShopProductRepositoryInterface
{
    public function paginate(int $perPage = 15): LengthAwarePaginator;
    public function findById(int $id): ?ShopProduct;
    public function create(array $data): ShopProduct;
    public function update(int $id, array $data): ?ShopProduct;
    public function delete(int $id): bool;
    public function forClub(string $clubSlug): Collection;
}
