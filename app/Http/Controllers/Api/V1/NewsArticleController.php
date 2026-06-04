<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreNewsArticleRequest;
use App\Http\Requests\Api\V1\UpdateNewsArticleRequest;
use App\Http\Resources\NewsArticleResource;
use App\Models\Club;
use App\Models\NewsArticle;
use App\Repositories\Contracts\NewsArticleRepositoryInterface;
use Illuminate\Http\Request;

class NewsArticleController extends Controller
{
    public function __construct(private readonly NewsArticleRepositoryInterface $repository) {}

    public function index(Request $request)
    {
        return NewsArticleResource::collection($this->repository->paginate((int) $request->integer('per_page', 15)));
    }

    public function store(StoreNewsArticleRequest $request)
    {
        $article = $this->repository->create($request->validated());

        return (new NewsArticleResource($article))->response()->setStatusCode(201);
    }

    public function show(NewsArticle $news)
    {
        return new NewsArticleResource($news);
    }

    public function update(UpdateNewsArticleRequest $request, NewsArticle $news)
    {
        $article = $this->repository->update($news->id, $request->validated());

        return new NewsArticleResource($article ?? $news);
    }

    public function destroy(NewsArticle $news)
    {
        $this->repository->delete($news->id);
        return response()->noContent();
    }

    public function clubArticles(Club $club)
    {
        return NewsArticleResource::collection($this->repository->forClub($club->slug));
    }
}
