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

    /**
     * Liste des clubs
     *
     * Retourne la liste paginée des clubs.
     *
     * @group Clubs
     * @unauthenticated
     *
     * @queryParam per_page integer Nombre d'éléments par page. Example: 15
     * @queryParam include string Relations à inclure (teams, teams.players, media). Example: teams,media
     */
    public function index(Request $request)
    {
        $relations = $this->extractAllowedIncludes($request->query('include'));
        $perPage = (int) $request->integer('per_page', 15);

        $clubs = $this->clubRepository->paginateWithRelations($perPage, $relations);

        return ClubResource::collection($clubs);
    }

    /**
     * Créer un club
     *
     * @group Clubs
     * @authenticated
     *
     * @bodyParam name string required Nom du club. Example: Hafia FC
     * @bodyParam slug string required Slug unique du club. Example: hafia-fc
     */
    public function store(StoreClubRequest $request): ClubResource
    {
        $club = $this->clubRepository->create($request->validated());

        $club = $this->clubRepository->findById($club->id, ['teams', 'media']);

        return new ClubResource($club);
    }

    /**
     * Détail d'un club
     *
     * @group Clubs
     * @unauthenticated
     *
     * @urlParam club string required ID ou slug du club (binding Laravel). Example: hafia-fc
     * @queryParam include string Relations à inclure (teams, teams.players, media). Example: teams.players
     */
    public function show(Request $request, Club $club): ClubResource
    {
        $relations = $this->extractAllowedIncludes($request->query('include'));
        $clubModel = $this->clubRepository->findBySlug($club->slug, $relations);

        return new ClubResource($clubModel ?? $club);
    }

    /**
     * Mettre à jour un club
     *
     * @group Clubs
     * @authenticated
     *
     * @urlParam club string required ID ou slug du club (binding Laravel). Example: hafia-fc
     * @bodyParam name string Nom du club. Example: Hafia FC
     * @bodyParam slug string Slug unique du club. Example: hafia-fc
     */
    public function update(UpdateClubRequest $request, Club $club): ClubResource
    {
        $updated = $this->clubRepository->update($club->id, $request->validated());

        return new ClubResource($updated ?? $club);
    }

    /**
     * Supprimer un club
     *
     * @group Clubs
     * @authenticated
     *
     * @urlParam club string required ID ou slug du club (binding Laravel). Example: hafia-fc
     */
    public function destroy(Club $club): JsonResponse
    {
        $this->clubRepository->delete($club->id);

        return response()->json(status: Response::HTTP_NO_CONTENT);
    }

    /**
     * Joueurs par categorie
     *
     * @group Clubs
     * @unauthenticated
     *
     * @urlParam club string required ID ou slug du club (binding Laravel). Example: hafia-fc
     * @urlParam category string required Catégorie de joueurs (goalkeeper, defender, midfielder, forward). Example: midfielder
     */
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
