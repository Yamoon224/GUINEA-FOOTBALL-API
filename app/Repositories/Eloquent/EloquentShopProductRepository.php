<?php

namespace App\Repositories\Eloquent;

use App\Models\ShopProduct;
use App\Repositories\Contracts\ShopProductRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class EloquentShopProductRepository implements ShopProductRepositoryInterface
{
    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return ShopProduct::query()->where('is_active', true)->paginate($perPage);
    }

    public function findById(int $id): ?ShopProduct
    {
        return ShopProduct::query()->find($id);
    }

    public function create(array $data): ShopProduct
    {
        return ShopProduct::query()->create($data);
    }

    public function update(int $id, array $data): ?ShopProduct
    {
        $item = ShopProduct::query()->find($id);
        if (! $item) {
            return null;
        }
        $item->update($data);
        return $item->refresh();
    }

    public function delete(int $id): bool
    {
        return (bool) ShopProduct::query()->whereKey($id)->delete();
    }

    public function forClub(string $clubSlug): Collection
    {
        return ShopProduct::query()
            ->whereHas('club', fn ($query) => $query->where('slug', $clubSlug))
            ->where('is_active', true)
            ->orderByDesc('is_new')
            ->orderBy('slug')
            ->get();
    }
}
