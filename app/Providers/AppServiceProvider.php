<?php

namespace App\Providers;

use App\Models\Club;
use App\Models\Player;
use App\Repositories\Contracts\ClubRepositoryInterface;
use App\Repositories\Contracts\ClubMatchRepositoryInterface;
use App\Repositories\Contracts\MediaRepositoryInterface;
use App\Repositories\Contracts\NewsArticleRepositoryInterface;
use App\Repositories\Contracts\ShopProductRepositoryInterface;
use App\Repositories\Contracts\StandingEntryRepositoryInterface;
use App\Repositories\Contracts\PlayerRepositoryInterface;
use App\Repositories\Eloquent\EloquentClubRepository;
use App\Repositories\Eloquent\EloquentClubMatchRepository;
use App\Repositories\Eloquent\EloquentMediaRepository;
use App\Repositories\Eloquent\EloquentNewsArticleRepository;
use App\Repositories\Eloquent\EloquentShopProductRepository;
use App\Repositories\Eloquent\EloquentStandingEntryRepository;
use App\Repositories\Eloquent\EloquentPlayerRepository;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ClubRepositoryInterface::class, EloquentClubRepository::class);
        $this->app->bind(PlayerRepositoryInterface::class, EloquentPlayerRepository::class);
        $this->app->bind(MediaRepositoryInterface::class, EloquentMediaRepository::class);
        $this->app->bind(NewsArticleRepositoryInterface::class, EloquentNewsArticleRepository::class);
        $this->app->bind(ClubMatchRepositoryInterface::class, EloquentClubMatchRepository::class);
        $this->app->bind(StandingEntryRepositoryInterface::class, EloquentStandingEntryRepository::class);
        $this->app->bind(ShopProductRepositoryInterface::class, EloquentShopProductRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Relation::enforceMorphMap([
            'club' => Club::class,
            'player' => Player::class,
        ]);
    }
}
