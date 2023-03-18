<?php

namespace App\Repositories\Contracts;

use Illuminate\Http\JsonResponse;

interface OscarRepositoryInterface
{
    public function findOscarByYear(int $year);
    public function addAwardToOscar(string $year, string $awardArtistId);
    public function removeAwardFromOscar(string $year, string $awardArtistId);
}
