<?php

namespace App\Repositories\Core\Eloquent;

use App\Models\AwardMovie;
use App\Repositories\Contracts\AwardMovieRepositoryInterface;

class EloquentAwardMovieRepository extends BaseEloquentRepository implements AwardMovieRepositoryInterface
{
    public function entity(): string
    {
        return AwardMovie::class;
    }
    public function findAwardMovieByName(string $name)
    {
        // TODO: Implement findAwardMovieByName() method.
    }

    public function addAwardToOscar(string $year, string $awardArtistId)
    {
        // TODO: Implement addAwardToOscar() method.
    }

    public function removeAwardFromOscar(string $year, string $awardArtistId)
    {
        // TODO: Implement removeAwardFromOscar() method.
    }
}
