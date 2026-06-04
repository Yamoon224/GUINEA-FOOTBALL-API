<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreMediaRequest;
use App\Http\Resources\MediaResource;
use App\Models\Club;
use App\Models\Media;
use App\Models\Player;
use App\Repositories\Contracts\MediaRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MediaController extends Controller
{
    public function __construct(
        private readonly MediaRepositoryInterface $mediaRepository
    ) {
    }

    public function index(Request $request)
    {
        $type = $request->query('mediable_type');
        $id = (int) $request->query('mediable_id');

        if (! $type || ! $id) {
            return response()->json([
                'message' => 'Les paramètres mediable_type et mediable_id sont requis.',
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $entity = $this->resolveMediable($type, $id);

        if (! $entity) {
            return response()->json(['message' => 'Entité introuvable.'], Response::HTTP_NOT_FOUND);
        }

        return MediaResource::collection($this->mediaRepository->getForEntity($entity));
    }

    public function store(StoreMediaRequest $request)
    {
        $payload = $request->validated();

        $entity = $this->resolveMediable($payload['mediable_type'], (int) $payload['mediable_id']);

        if (! $entity) {
            return response()->json(['message' => 'Entité introuvable.'], Response::HTTP_NOT_FOUND);
        }

        unset($payload['mediable_type'], $payload['mediable_id']);

        $media = $this->mediaRepository->attachTo($entity, $payload);

        return (new MediaResource($media))->response()->setStatusCode(Response::HTTP_CREATED);
    }

    public function destroy(Media $media): JsonResponse
    {
        $this->mediaRepository->delete($media->id);

        return response()->json(status: Response::HTTP_NO_CONTENT);
    }

    private function resolveMediable(string $type, int $id): Club|Player|null
    {
        return match ($type) {
            'club' => Club::query()->find($id),
            'player' => Player::query()->find($id),
            default => null,
        };
    }
}
