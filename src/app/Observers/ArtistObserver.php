<?php

namespace App\Observers;

use App\Helpers\ShortLinkApi;
use App\Models\Artist;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class ArtistObserver
{
    /**
     * Handle the Artist "created" event.
     */
    public function created(Artist $artist): void
    {
        //
    }

    /**
     * @throws GuzzleException
     * @throws \JsonException
     */
    public function creating(Artist $artist): void
    {
        $artist->wikipedia = ShortLinkApi::getShortLink($artist->wikipedia);
    }

    /**
     * Handle the Artist "updated" event.
     */
    public function updated(Artist $artist): void
    {
        //
    }

    /**
     * @throws GuzzleException
     * @throws \JsonException
     */
    public function updating(Artist $artist):void
    {
        $artist->wikipedia = ShortLinkApi::getShortLink($artist->wikipedia);
    }

    /**
     * Handle the Artist "deleted" event.
     */
    public function deleted(Artist $artist): void
    {
        //
    }

    /**
     * Handle the Artist "restored" event.
     */
    public function restored(Artist $artist): void
    {
        //
    }

    /**
     * Handle the Artist "force deleted" event.
     */
    public function forceDeleted(Artist $artist): void
    {
        //
    }
}
