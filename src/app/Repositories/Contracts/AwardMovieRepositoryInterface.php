<?php

namespace App\Repositories\Contracts;

interface AwardMovieRepositoryInterface
{
    public function findAwardMovieByName(string $name);
    public function addAwardToOscar(string $year, string $awardArtistId);
    public function removeAwardFromOscar(string $year, string $awardArtistId);
}
