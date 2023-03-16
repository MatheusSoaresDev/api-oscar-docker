<?php

namespace App\Repositories\Contracts;

use Illuminate\Http\JsonResponse;

interface AwardArtistExceptionInterface
{
    public function bindOscarAwardArtist(array $data): JsonResponse;
}
