<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StorePlayerRequest;
use App\Http\Requests\Api\V1\UpdatePlayerRequest;
use App\Http\Resources\PlayerResource;
use App\Models\Player;
use App\Repositories\Contracts\PlayerRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PlayerController extends Controller
{
    public function __construct(
        private readonly PlayerRepositoryInterface $playerRepository
    ) {
    }

    /**
     * Liste des joueurs
     *
     * Retourne la liste paginée des joueurs avec filtres optionnels.
     *
     * @group Joueurs
     * @unauthenticated
     *
     * @queryParam per_page integer Nombre d'éléments par page. Example: 15
     * @queryParam team_id integer Filtrer par équipe. Example: 2
     * @queryParam club_slug string Filtrer par club (slug). Example: hafia-fc
     */
    public function index(Request $request)
    {
        $filters = [
            'team_id' => $request->query('team_id'),
            'club_slug' => $request->query('club_slug'),
        ];

        $players = $this->playerRepository->search(
            filters: array_filter($filters, fn ($value) => $value !== null && $value !== ''),
            perPage: (int) $request->integer('per_page', 15),
            relations: ['team', 'media']
        );

        return PlayerResource::collection($players);
    }

    /**
     * Créer un joueur
     *
     * @group Joueurs
     * @authenticated
     *
     * @bodyParam name string required Nom complet du joueur. Example: Naby Keita
     * @bodyParam team_id integer required ID de l'équipe du joueur. Example: 3
     * @bodyParam position string required Poste du joueur. Example: midfielder
     */
    public function store(StorePlayerRequest $request): PlayerResource
    {
        $player = $this->playerRepository->create($request->validated());
        $player = $this->playerRepository->findById($player->id, ['team', 'media']);

        return new PlayerResource($player);
    }

    /**
     * Détail d'un joueur
     *
     * @group Joueurs
     * @unauthenticated
     *
     * @urlParam player integer required ID du joueur. Example: 10
     */
    public function show(Player $player): PlayerResource
    {
        $playerModel = $this->playerRepository->findById($player->id, ['team', 'media']);

        return new PlayerResource($playerModel ?? $player);
    }

    /**
     * Mettre à jour un joueur
     *
     * @group Joueurs
     * @authenticated
     *
     * @urlParam player integer required ID du joueur. Example: 10
     * @bodyParam name string Nom complet du joueur. Example: Naby Keita
     * @bodyParam team_id integer ID de l'équipe du joueur. Example: 3
     * @bodyParam position string Poste du joueur. Example: midfielder
     */
    public function update(UpdatePlayerRequest $request, Player $player): PlayerResource
    {
        $updated = $this->playerRepository->update($player->id, $request->validated());

        return new PlayerResource($updated ?? $player);
    }

    /**
     * Supprimer un joueur
     *
     * @group Joueurs
     * @authenticated
     *
     * @urlParam player integer required ID du joueur. Example: 10
     */
    public function destroy(Player $player): JsonResponse
    {
        $this->playerRepository->delete($player->id);

        return response()->json(status: Response::HTTP_NO_CONTENT);
    }
}
