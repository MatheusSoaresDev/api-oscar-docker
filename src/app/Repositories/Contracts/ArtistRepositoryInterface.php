<?php

namespace App\Repositories\Contracts;

interface ArtistRepositoryInterface
{
    public function addArtistToNomineeArtist(string $artistId, string $movieId);
    public function removeArtistFromNomineeArtist(string $artistId, string $movieId);
}
