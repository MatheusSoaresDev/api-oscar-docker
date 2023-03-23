<?php

namespace App\Repositories\Contracts;

interface ArtistRepositoryInterface
{
    public function addNomineeArtistToOscar(string $yearOscar, array $data);
    public function removeNomineeArtistFromOscar(string $yearOscar, array $data);
}
