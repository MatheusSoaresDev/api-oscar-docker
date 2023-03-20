<?php

namespace App\Repositories\Contracts;

use Illuminate\Http\JsonResponse;

interface ArtistExceptionInterface
{
    public function addArtistToNomineeArtist(string $artistId, string $movieId): JsonResponse;
    public function removeArtistFromNomineeArtist(string $artistId, string $movieId): JsonResponse;
}
