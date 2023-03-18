<?php

namespace App\Repositories\Core\Eloquent;

use App\Models\AwardArtist;
use App\Repositories\Contracts\AwardArtistRepositoryInterface;

class EloquentAwardArtistRepository extends BaseEloquentRepository implements AwardArtistRepositoryInterface
{
    public function entity(): string
    {
        return AwardArtist::class;
    }

    public function findAwardArtistByName(string $name)
    {
        // TODO: Implement findAwardArtistByName() method.
    }
}
