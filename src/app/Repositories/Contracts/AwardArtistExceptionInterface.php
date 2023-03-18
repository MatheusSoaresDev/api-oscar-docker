<?php

namespace App\Repositories\Contracts;

use Illuminate\Http\JsonResponse;

interface AwardArtistExceptionInterface
{
    public function findAwardArtistByName(string $name):JsonResponse;
}
