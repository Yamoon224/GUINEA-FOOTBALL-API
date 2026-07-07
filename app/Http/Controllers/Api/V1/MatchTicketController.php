<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreMatchTicketRequest;
use App\Http\Requests\Api\V1\UpdateMatchTicketRequest;
use App\Http\Resources\MatchTicketResource;
use App\Models\Club;
use App\Models\MatchTicket;
use App\Repositories\Contracts\MatchTicketRepositoryInterface;
use Illuminate\Http\Request;

class MatchTicketController extends Controller
{
    public function __construct(private readonly MatchTicketRepositoryInterface $repository) {}

    public function index(Request $request)
    {
        return MatchTicketResource::collection($this->repository->paginate((int) $request->integer('per_page', 15)));
    }

    public function store(StoreMatchTicketRequest $request)
    {
        $entry = $this->repository->create($request->validated());

        return (new MatchTicketResource($entry))->response()->setStatusCode(201);
    }

    public function show(MatchTicket $ticket)
    {
        return new MatchTicketResource($ticket);
    }

    public function update(UpdateMatchTicketRequest $request, MatchTicket $ticket)
    {
        $entry = $this->repository->update($ticket->id, $request->validated());

        return new MatchTicketResource($entry ?? $ticket);
    }

    public function destroy(MatchTicket $ticket)
    {
        $this->repository->delete($ticket->id);

        return response()->noContent();
    }

    public function clubBillets(Club $club)
    {
        $grouped = $this->repository->forClub($club->slug);

        $matches = $grouped->map(function ($tickets) {
            $match = $tickets->first()->match;

            return [
                'matchId' => $match->id,
                'adversaire' => $match->opponent,
                'date' => optional($match->match_date)->toDateString(),
                'competition' => $match->competition,
                'stade' => $match->stadium,
                'categorie' => $match->category,
                'billets' => $tickets->map(fn ($ticket) => [
                    'type' => $ticket->type,
                    'prix' => $ticket->price,
                    'disponible' => $ticket->available,
                    'total' => $ticket->total,
                ])->values(),
            ];
        })->values();

        return response()->json($matches);
    }
}
