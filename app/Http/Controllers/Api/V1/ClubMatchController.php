<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreClubMatchRequest;
use App\Http\Requests\Api\V1\UpdateClubMatchRequest;
use App\Http\Resources\ClubMatchResource;
use App\Models\Club;
use App\Models\ClubMatch;
use App\Repositories\Contracts\ClubMatchRepositoryInterface;
use Illuminate\Http\Request;

class ClubMatchController extends Controller
{
    public function __construct(private readonly ClubMatchRepositoryInterface $repository) {}

    public function index(Request $request)
    {
        return ClubMatchResource::collection($this->repository->paginate((int) $request->integer('per_page', 15)));
    }

    public function store(StoreClubMatchRequest $request)
    {
        $match = $this->repository->create($request->validated());

        return (new ClubMatchResource($match))->response()->setStatusCode(201);
    }

    public function show(ClubMatch $match)
    {
        return new ClubMatchResource($match);
    }

    public function update(UpdateClubMatchRequest $request, ClubMatch $match)
    {
        $updated = $this->repository->update($match->id, $request->validated());

        return new ClubMatchResource($updated ?? $match);
    }

    public function destroy(ClubMatch $match)
    {
        $this->repository->delete($match->id);
        return response()->noContent();
    }

    public function clubCalendar(Club $club)
    {
        return ClubMatchResource::collection($this->repository->upcomingForClub($club->slug));
    }

    public function clubResults(Club $club)
    {
        return ClubMatchResource::collection($this->repository->resultsForClub($club->slug));
    }
}
