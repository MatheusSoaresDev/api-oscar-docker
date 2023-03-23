<?php

namespace App\Repositories\Contracts;

use Illuminate\Http\JsonResponse;

interface ArtistExceptionInterface
{
    public function addNomineeArtistToOscar(string $yearOscar, array $data): JsonResponse;
    public function removeNomineeArtistFromOscar(string $yearOscar, array $data): JsonResponse;
}
