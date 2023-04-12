<?php

namespace App\Providers;

use App\Models\Artist;
use App\Models\Movie;
use App\Models\Oscar;
use App\Observers\ArtistObserver;
use App\Observers\MovieObserver;
use App\Observers\OscarObserver;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        Oscar::observe(OscarObserver::class);
        Artist::observe(ArtistObserver::class);
        Movie::observe(MovieObserver::class);
    }
}
