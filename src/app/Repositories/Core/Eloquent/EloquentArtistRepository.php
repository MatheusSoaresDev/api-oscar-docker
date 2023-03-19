<?php

namespace App\Repositories\Core\Eloquent;

use App\Models\Artist;
use App\Repositories\Contracts\ArtistRepositoryInterface;

class EloquentArtistRepository extends BaseEloquentRepository implements ArtistRepositoryInterface
{
    public function entity(): string
    {
        return Artist::class;
    }
    public function addArtistToNomineeArtist(string $artistId, string $movieId)
    {
        // TODO: Implement addArtistToNomineeArtist() method.
    }

    public function removeArtistFromNomineeArtist(string $artistId, string $movieId)
    {
        // TODO: Implement removeArtistFromNomineeArtist() method.
    }
}
