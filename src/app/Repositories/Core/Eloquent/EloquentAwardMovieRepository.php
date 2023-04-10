<?php

namespace App\Repositories\Core\Eloquent;

use App\Exceptions\OscarAlreadyHasAwardArtistException;
use App\Exceptions\OscarDoesntHaveItAwardException;
use App\Models\AwardMovie;
use App\Models\Oscar;
use App\Repositories\Contracts\AwardMovieRepositoryInterface;
use App\Repositories\Contracts\ReadOnlyInterface;
use http\Exception\RuntimeException;
use Illuminate\Support\Str;

class EloquentAwardMovieRepository extends BaseEloquentRepository implements AwardMovieRepositoryInterface, ReadOnlyInterface
{
    public function entity(): string
    {
        return AwardMovie::class;
    }

    public function update(string $id, array $data):void
    {
        throw new RuntimeException("This repository can't to change.", 500);
    }

    public function delete(string $id):void
    {
        throw new RuntimeException("This repository can't be deleted.", 500);
    }

    public function findAwardMovieByName(string $name)
    {
        // TODO: Implement findAwardMovieByName() method.
    }

    public function addAwardToOscar(string $year, string $awardMovieId):void
    {
        $awardMovie = $this->findById($awardMovieId);
        $oscar = Oscar::where("year", $year)->firstOrFail();
        $pivotTable = $oscar->awardMoviesRelation()->find($awardMovie->id);

        if($pivotTable) {
            throw new OscarAlreadyHasAwardArtistException("This award already was added to the ceremony.", 500);
        }

        $oscar->awardMoviesRelation()->attach($awardMovie->id, ["id" => Str::uuid(), "created_at" => now(), "updated_at" => now()], false);
    }

    public function removeAwardFromOscar(string $year, string $awardMovieId): void
    {
        $awardMovie = $this->findById($awardMovieId);
        $oscar = Oscar::where("year", $year)->firstOrFail();
        $pivotTable = $oscar->awardMoviesRelation()->find($awardMovie->id);

        if(!$pivotTable) {
            throw new OscarDoesntHaveItAwardException("This award doesn't exist in the ceremony.", 500);
        }

        $oscar->awardMoviesRelation()->detach($awardMovie->id);
    }
}
