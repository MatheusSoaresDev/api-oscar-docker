<?php

namespace App\Providers;

use App\Models\Artist;
use App\Models\Oscar;
use App\Observers\ArtistObserver;
use App\Observers\OscarObserver;
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
        Oscar::observe(OscarObserver::class);
        Artist::observe(ArtistObserver::class);
    }
}
