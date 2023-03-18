<?php

namespace App\Repositories\Contracts;

use Illuminate\Http\JsonResponse;

interface OscarExceptionInterface
{
    public function findOscarByYear(int $year):JsonResponse;
    public function addAwardToOscar(string $year, string $awardArtistId):JsonResponse;
    public function removeAwardFromOscar(string $year, string $awardArtistId):JsonResponse;
}
