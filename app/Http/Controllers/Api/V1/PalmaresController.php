<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StorePalmaresRequest;
use App\Http\Requests\Api\V1\UpdatePalmaresRequest;
use App\Http\Resources\PalmaresResource;
use App\Models\Club;
use App\Models\Palmares;
use App\Repositories\Contracts\PalmaresRepositoryInterface;
use Illuminate\Http\Request;

class PalmaresController extends Controller
{
    public function __construct(private readonly PalmaresRepositoryInterface $repository) {}

    public function index(Request $request)
    {
        return PalmaresResource::collection($this->repository->paginate((int) $request->integer('per_page', 15)));
    }

    public function store(StorePalmaresRequest $request)
    {
        $entry = $this->repository->create($request->validated());

        return (new PalmaresResource($entry))->response()->setStatusCode(201);
    }

    public function show(Palmares $palmares)
    {
        return new PalmaresResource($palmares);
    }

    public function update(UpdatePalmaresRequest $request, Palmares $palmares)
    {
        $entry = $this->repository->update($palmares->id, $request->validated());

        return new PalmaresResource($entry ?? $palmares);
    }

    public function destroy(Palmares $palmares)
    {
        $this->repository->delete($palmares->id);

        return response()->noContent();
    }

    public function clubPalmares(Club $club)
    {
        return PalmaresResource::collection($this->repository->forClub($club->slug));
    }
}
