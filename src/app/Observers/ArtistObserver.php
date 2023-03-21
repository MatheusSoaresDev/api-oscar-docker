<?php

namespace App\Observers;

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
        $client = new Client(["base_uri" => "https://api.shrtco.de/v2/"]);
        $response = $client->request("POST", "shorten?url=$artist->wikipedia");

        $result = json_decode($response->getBody()->getContents(), false, 512, JSON_THROW_ON_ERROR);

        $artist->wikipedia = $result->result->short_link;
    }

    /**
     * Handle the Artist "updated" event.
     */
    public function updated(Artist $artist): void
    {
        //
    }

    public function updating(Artist $artist):void
    {
        $client = new Client(["base_uri" => "https://api.shrtco.de/v2/"]);
        $response = $client->request("POST", "shorten?url=$artist->wikipedia");

        $result = json_decode($response->getBody()->getContents(), false, 512, JSON_THROW_ON_ERROR);

        $artist->wikipedia = $result->result->short_link;
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
