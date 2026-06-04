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

    public function store(StorePlayerRequest $request): PlayerResource
    {
        $player = $this->playerRepository->create($request->validated());
        $player = $this->playerRepository->findById($player->id, ['team', 'media']);

        return new PlayerResource($player);
    }

    public function show(Player $player): PlayerResource
    {
        $playerModel = $this->playerRepository->findById($player->id, ['team', 'media']);

        return new PlayerResource($playerModel ?? $player);
    }

    public function update(UpdatePlayerRequest $request, Player $player): PlayerResource
    {
        $updated = $this->playerRepository->update($player->id, $request->validated());

        return new PlayerResource($updated ?? $player);
    }

    public function destroy(Player $player): JsonResponse
    {
        $this->playerRepository->delete($player->id);

        return response()->json(status: Response::HTTP_NO_CONTENT);
    }
}
