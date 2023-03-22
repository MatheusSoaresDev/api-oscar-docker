<?php

namespace App\Repositories\Contracts;

use Illuminate\Http\JsonResponse;

interface AwardArtistExceptionInterface
{
    public function findAwardArtistByName(string $name):JsonResponse;
    public function addAwardToOscar(string $year, string $awardArtistId):JsonResponse;
    public function removeAwardFromOscar(string $year, string $awardArtistId):JsonResponse;
}
