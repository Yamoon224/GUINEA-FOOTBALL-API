<?php

use App\Http\Controllers\Api\V1\ClubController;
use App\Http\Controllers\Api\V1\ClubMatchController;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\MediaController;
use App\Http\Controllers\Api\V1\NewsArticleController;
use App\Http\Controllers\Api\V1\ShopProductController;
use App\Http\Controllers\Api\V1\StandingEntryController;
use App\Http\Controllers\Api\V1\PlayerController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function (): void {
    Route::post('auth/login', [AuthController::class, 'login']);

    Route::middleware(['auth:sanctum', 'admin'])->group(function (): void {
        Route::get('auth/me', [AuthController::class, 'me']);
        Route::post('auth/logout', [AuthController::class, 'logout']);

        Route::apiResource('clubs', ClubController::class)->except(['index', 'show']);
        Route::apiResource('players', PlayerController::class)->except(['index', 'show']);
        Route::apiResource('news', NewsArticleController::class)->except(['index', 'show']);
        Route::apiResource('matches', ClubMatchController::class)->except(['index', 'show']);
        Route::apiResource('standings', StandingEntryController::class)->except(['index', 'show']);
        Route::apiResource('products', ShopProductController::class)->except(['index', 'show']);

        Route::post('media', [MediaController::class, 'store']);
        Route::delete('media/{media}', [MediaController::class, 'destroy']);
    });

    Route::apiResource('clubs', ClubController::class)->only(['index', 'show']);
    Route::get('clubs/{club}/players/{category}', [ClubController::class, 'playersByCategory']);
    Route::get('clubs/{club}/actualites', [NewsArticleController::class, 'clubArticles']);
    Route::get('clubs/{club}/calendrier', [ClubMatchController::class, 'clubCalendar']);
    Route::get('clubs/{club}/resultats', [ClubMatchController::class, 'clubResults']);
    Route::get('clubs/{club}/classement', [StandingEntryController::class, 'clubStandings']);
    Route::get('clubs/{club}/boutique', [ShopProductController::class, 'clubProducts']);

    Route::apiResource('players', PlayerController::class)->only(['index', 'show']);
    Route::apiResource('news', NewsArticleController::class)->only(['index', 'show']);
    Route::apiResource('matches', ClubMatchController::class)->only(['index', 'show']);
    Route::apiResource('standings', StandingEntryController::class)->only(['index', 'show']);
    Route::apiResource('products', ShopProductController::class)->only(['index', 'show']);

    Route::get('media', [MediaController::class, 'index']);
});
