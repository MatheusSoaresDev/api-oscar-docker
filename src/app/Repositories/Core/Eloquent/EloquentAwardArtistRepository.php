<?php

namespace App\Repositories\Core\Eloquent;

use App\Exceptions\OscarAlreadyHasAwardArtistException;
use App\Exceptions\OscarDoesntHaveItAwardException;
use App\Models\AwardArtist;
use App\Models\Oscar;
use App\Repositories\Contracts\AwardArtistRepositoryInterface;
use Illuminate\Support\Str;

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

    public function addAwardToOscar(string $year, string $awardArtistId)
    {
        $awardArtist = $this->findById($awardArtistId);
        $oscar = Oscar::where("year", $year)->firstOrFail();
        $pivotTable = $oscar->awardArtists()->find($awardArtist->id);

        if($pivotTable) {
            throw new OscarAlreadyHasAwardArtistException("This award already was added to the ceremony.", 500);
        }

        $oscar->awardArtists()->attach($awardArtist->id, ["id" => Str::uuid(), "created_at" => now(), "updated_at" => now()], false);
        return $this->entity->where("id", $oscar->id)->with(["awards_artists.award"])->get();
    }

    public function removeAwardFromOscar(string $year, string $awardArtistId)
    {
        $awardArtist = $this->findById($awardArtistId);
        $oscar = Oscar::where("year", $year)->firstOrFail();
        $pivotTable = $oscar->awardArtists()->find($awardArtist->id);

        if(!$pivotTable) {
            throw new OscarDoesntHaveItAwardException("This award doesn't exist in the ceremony.", 500);
        }

        $oscar->awardArtists()->detach($awardArtist->id);
        return $this->entity->where("id", $oscar->id)->with(["awards_artists.award"])->get();
    }
}
