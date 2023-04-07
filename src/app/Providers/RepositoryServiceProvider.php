<?php

namespace App\Providers;

use App\Repositories\Contracts\ArtistExceptionInterface;
use App\Repositories\Contracts\ArtistRepositoryInterface;
use App\Repositories\Contracts\AwardArtistExceptionInterface;
use App\Repositories\Contracts\AwardArtistRepositoryInterface;
use App\Repositories\Contracts\AwardMovieExceptionInterface;
use App\Repositories\Contracts\AwardMovieRepositoryInterface;
use App\Repositories\Contracts\MovieExceptionInterface;
use App\Repositories\Contracts\MovieRepositoryInterface;
use App\Repositories\Contracts\OscarExceptionInterface;
use App\Repositories\Contracts\OscarRepositoryInterface;
use App\Repositories\Core\Eloquent\EloquentArtistRepository;
use App\Repositories\Core\Eloquent\EloquentAwardArtistRepository;
use App\Repositories\Core\Eloquent\EloquentAwardMovieRepository;
use App\Repositories\Core\Eloquent\EloquentMovieRepository;
use App\Repositories\Core\Eloquent\EloquentOscarRepository;
use App\Repositories\Exceptions\Eloquent\EloquentArtistException;
use App\Repositories\Exceptions\Eloquent\EloquentAwardArtistException;
use App\Repositories\Exceptions\Eloquent\EloquentAwardMovieException;
use App\Repositories\Exceptions\Eloquent\EloquentMovieException;
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

        /* Award Movies Repositories */
        $this->app->bind(AwardMovieRepositoryInterface::class, EloquentAwardMovieRepository::class);
        $this->app->bind(AwardMovieExceptionInterface::class, EloquentAwardMovieException::class);
        /* ------------------- */

        /* Artist Repositories */
        $this->app->bind(ArtistRepositoryInterface::class, EloquentArtistRepository::class);
        $this->app->bind(ArtistExceptionInterface::class, EloquentArtistException::class);
        /* ------------------- */

        /* Movie Repositories */
        $this->app->bind(MovieRepositoryInterface::class, EloquentMovieRepository::class);
        $this->app->bind(MovieExceptionInterface::class, EloquentMovieException::class);
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
