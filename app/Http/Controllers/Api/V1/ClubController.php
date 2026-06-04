<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreClubRequest;
use App\Http\Requests\Api\V1\UpdateClubRequest;
use App\Http\Resources\ClubResource;
use App\Http\Resources\PlayerResource;
use App\Models\Club;
use App\Repositories\Contracts\ClubRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClubController extends Controller
{
    public function __construct(
        private readonly ClubRepositoryInterface $clubRepository
    ) {
    }

    public function index(Request $request)
    {
        $relations = $this->extractAllowedIncludes($request->query('include'));
        $perPage = (int) $request->integer('per_page', 15);

        $clubs = $this->clubRepository->paginateWithRelations($perPage, $relations);

        return ClubResource::collection($clubs);
    }

    public function store(StoreClubRequest $request): ClubResource
    {
        $club = $this->clubRepository->create($request->validated());

        $club = $this->clubRepository->findById($club->id, ['teams', 'media']);

        return new ClubResource($club);
    }

    public function show(Request $request, Club $club): ClubResource
    {
        $relations = $this->extractAllowedIncludes($request->query('include'));
        $clubModel = $this->clubRepository->findBySlug($club->slug, $relations);

        return new ClubResource($clubModel ?? $club);
    }

    public function update(UpdateClubRequest $request, Club $club): ClubResource
    {
        $updated = $this->clubRepository->update($club->id, $request->validated());

        return new ClubResource($updated ?? $club);
    }

    public function destroy(Club $club): JsonResponse
    {
        $this->clubRepository->delete($club->id);

        return response()->json(status: Response::HTTP_NO_CONTENT);
    }

    public function playersByCategory(Club $club, string $category)
    {
        $players = $this->clubRepository->getPlayersByCategory($club->slug, $category);

        return PlayerResource::collection($players);
    }

    private function extractAllowedIncludes(?string $include): array
    {
        if (! $include) {
            return [];
        }

        $allowed = ['teams', 'teams.players', 'media'];
        $requested = array_map('trim', explode(',', $include));

        return array_values(array_intersect($requested, $allowed));
    }
}
