<?php

namespace App\Repositories\Contracts;

interface AwardArtistRepositoryInterface
{
    public function findAwardArtistByName(string $name);
    public function addAwardToOscar(string $year, string $awardArtistId);
    public function removeAwardFromOscar(string $year, string $awardArtistId);
}
