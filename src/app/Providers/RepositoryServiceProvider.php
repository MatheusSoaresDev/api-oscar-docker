<?php

namespace App\Providers;

use App\Repositories\Contracts\AwardArtistExceptionInterface;
use App\Repositories\Contracts\AwardArtistRepositoryInterface;
use App\Repositories\Contracts\OscarExceptionInterface;
use App\Repositories\Contracts\OscarRepositoryInterface;
use App\Repositories\Core\Eloquent\EloquentAwardArtistRepository;
use App\Repositories\Core\Eloquent\EloquentOscarRepository;
use App\Repositories\Exceptions\Eloquent\EloquentAwardArtistException;
use App\Repositories\Exceptions\Eloquent\EloquentOscarException;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        /* Oscar Ceremony Repositories */
        $this->app->bind(OscarRepositoryInterface::class, EloquentOscarRepository::class);
        $this->app->bind(OscarExceptionInterface::class, EloquentOscarException::class);
        /* ------------------- */

        /* Award Artist Repositories */
        $this->app->bind(AwardArtistRepositoryInterface::class, EloquentAwardArtistRepository::class);
        $this->app->bind(AwardArtistExceptionInterface::class, EloquentAwardArtistException::class);
        /* ------------------- */
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
