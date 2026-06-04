<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreStandingEntryRequest;
use App\Http\Requests\Api\V1\UpdateStandingEntryRequest;
use App\Http\Resources\StandingEntryResource;
use App\Models\Club;
use App\Models\StandingEntry;
use App\Repositories\Contracts\StandingEntryRepositoryInterface;
use Illuminate\Http\Request;

class StandingEntryController extends Controller
{
    public function __construct(private readonly StandingEntryRepositoryInterface $repository) {}

    public function index(Request $request)
    {
        return StandingEntryResource::collection($this->repository->paginate((int) $request->integer('per_page', 15)));
    }

    public function store(StoreStandingEntryRequest $request)
    {
        $entry = $this->repository->create($request->validated());

        return (new StandingEntryResource($entry))->response()->setStatusCode(201);
    }

    public function show(StandingEntry $standing)
    {
        return new StandingEntryResource($standing);
    }

    public function update(UpdateStandingEntryRequest $request, StandingEntry $standing)
    {
        $entry = $this->repository->update($standing->id, $request->validated());

        return new StandingEntryResource($entry ?? $standing);
    }

    public function destroy(StandingEntry $standing)
    {
        $this->repository->delete($standing->id);
        return response()->noContent();
    }

    public function clubStandings(Club $club)
    {
        $entries = $this->repository->forClub($club->slug);

        return response()->json(
            $entries->groupBy(fn ($item) => $item->competition.'|'.$item->category.'|'.$item->season)
                ->values()
                ->map(function ($group) {
                    $first = $group->first();

                    return [
                        'competition' => $first->competition,
                        'categorie' => $first->category,
                        'saison' => $first->season,
                        'entrees' => $group->map(fn ($entry) => (new StandingEntryResource($entry))->toArray(request()))->values(),
                    ];
                })
        );
    }
}
