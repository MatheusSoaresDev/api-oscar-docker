<?php

namespace App\Observers;

use App\Helpers\ShortLinkApi;
use App\Models\Movie;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class MovieObserver
{
    /**
     * Handle the Movie "created" event.
     */
    public function created(Movie $movie): void
    {
        //
    }

    /**
     * @throws GuzzleException
     * @throws \JsonException
     */
    public function creating(Movie $movie): void
    {
        $movie->wikipedia = ShortLinkApi::getShortLink($movie->wikipedia);
    }

    /**
     * Handle the Movie "updated" event.
     */
    public function updated(Movie $movie): void
    {
        //
    }

    /**
     * @throws GuzzleException
     * @throws \JsonException
     */
    public function updating(Movie $movie): void
    {
        $movie->wikipedia = ShortLinkApi::getShortLink($movie->wikipedia);
    }

    /**
     * Handle the Movie "deleted" event.
     */
    public function deleted(Movie $movie): void
    {
        //
    }

    /**
     * Handle the Movie "restored" event.
     */
    public function restored(Movie $movie): void
    {
        //
    }

    /**
     * Handle the Movie "force deleted" event.
     */
    public function forceDeleted(Movie $movie): void
    {
        //
    }
}
