<?php

namespace App\Repositories\Contracts;

interface AwardArtistRepositoryInterface
{
    public function findAwardArtistByName(string $name);
}
