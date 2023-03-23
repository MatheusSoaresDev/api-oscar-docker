<?php

namespace App\Repositories\Core\Eloquent;

use App\Models\Movie;
use App\Repositories\Contracts\MovieRepositoryInterface;

class EloquentMovieRepository extends BaseEloquentRepository implements MovieRepositoryInterface
{
    public function entity(): string
    {
        return Movie::class;
    }

    public function getRateInSiteRating()
    {
        // TODO: Implement getRateInSiteRating() method.
    }
}
