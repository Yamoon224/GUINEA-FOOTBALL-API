<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreShopProductRequest;
use App\Http\Requests\Api\V1\UpdateShopProductRequest;
use App\Http\Resources\ShopProductResource;
use App\Models\Club;
use App\Models\ShopProduct;
use App\Repositories\Contracts\ShopProductRepositoryInterface;
use Illuminate\Http\Request;

class ShopProductController extends Controller
{
    public function __construct(private readonly ShopProductRepositoryInterface $repository) {}

    public function index(Request $request)
    {
        return ShopProductResource::collection($this->repository->paginate((int) $request->integer('per_page', 15)));
    }

    public function store(StoreShopProductRequest $request)
    {
        $product = $this->repository->create($request->validated());

        return (new ShopProductResource($product))->response()->setStatusCode(201);
    }

    public function show(ShopProduct $product)
    {
        return new ShopProductResource($product);
    }

    public function update(UpdateShopProductRequest $request, ShopProduct $product)
    {
        $updated = $this->repository->update($product->id, $request->validated());

        return new ShopProductResource($updated ?? $product);
    }

    public function destroy(ShopProduct $product)
    {
        $this->repository->delete($product->id);
        return response()->noContent();
    }

    public function clubProducts(Club $club)
    {
        return ShopProductResource::collection($this->repository->forClub($club->slug));
    }
}
