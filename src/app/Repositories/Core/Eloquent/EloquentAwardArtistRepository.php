<?php

namespace App\Repositories\Core\Eloquent;

use App\Exceptions\OscarAlreadyHasAwardArtistException;
use App\Exceptions\OscarDoesntHaveItAwardException;
use App\Models\AwardArtist;
use App\Models\Oscar;
use App\Repositories\Contracts\AwardArtistRepositoryInterface;
use App\Repositories\Contracts\ReadOnlyInterface;
use http\Exception\RuntimeException;
use Illuminate\Support\Str;

class EloquentAwardArtistRepository extends BaseEloquentRepository implements AwardArtistRepositoryInterface, ReadOnlyInterface
{
    public function entity(): string
    {
        return AwardArtist::class;
    }

    public function update(string $id, array $data):void
    {
        throw new RuntimeException("This repository can't to change.", 500);
    }

    public function delete(string $id):void
    {
        throw new RuntimeException("This repository can't be deleted.");
    }

    public function findAwardArtistByName(string $name)
    {
        // TODO: Implement findAwardArtistByName() method.
    }

    public function addAwardToOscar(string $year, string $awardArtistId):void
    {
        $awardArtist = $this->findById($awardArtistId);
        $oscar = Oscar::where("year", $year)->firstOrFail();
        $pivotTable = $oscar->awardArtistsRelation()->find($awardArtist->id);

        if($pivotTable) {
            throw new OscarAlreadyHasAwardArtistException("This award already was added to the ceremony.", 500);
        }

        $oscar->awardArtistsRelation()->attach($awardArtist->id, ["id" => Str::uuid(), "created_at" => now(), "updated_at" => now()], false);
    }

    public function removeAwardFromOscar(string $year, string $awardArtistId):void
    {
        $awardArtist = $this->findById($awardArtistId);
        $oscar = Oscar::where("year", $year)->firstOrFail();
        $pivotTable = $oscar->awardArtistsRelation()->find($awardArtist->id);

        if(!$pivotTable) {
            throw new OscarDoesntHaveItAwardException("This award doesn't exist in the ceremony.", 500);
        }

        $oscar->awardArtistsRelation()->detach($awardArtist->id);
    }
}
