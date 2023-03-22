<?php

namespace App\Repositories\Contracts;

interface ArtistRepositoryInterface
{
    public function addNomineeArtistToOscar(string $yearOscar, array $data);
    public function removeNomineeArtistToOscar(string $yearOscar, array $data);
}
