<?php

namespace App\Repositories\Core\Eloquent;

use App\Exceptions\RelationNotExistsException;
use App\Models\AwardArtist;
use App\Models\Oscar;
use App\Repositories\Contracts\OscarRepositoryInterface;
use App\Transforms\TransformCreateManyCuriosities;
use App\Transforms\TransformCreateManyHostsOscar;
use Illuminate\Support\Str;

class EloquentOscarRepository extends BaseEloquentRepository implements OscarRepositoryInterface
{
    public function entity(): string
    {
        return Oscar::class;
    }

    public function store(array $data)
    {
        $oscar = parent::store($data);
        $oscar->hosts()->createMany(TransformCreateManyHostsOscar::handle($data));
        $oscar->curiosities()->createMany(TransformCreateManyCuriosities::handle($data));
        return $oscar;
    }

    public function update(string $id, array $data)
    {
        $uuid = $this->findOscarByYear($id);
        return parent::update($uuid->id, $data);
    }

    public function delete(string $id)
    {
        $uuid = $this->findOscarByYear($id);
        return parent::delete($uuid->id);
    }

    public function findOscarByYear(int $year)
    {
        return $this->entity->whereYear("date", $year)->with(["hosts", "curiosities", "awards_artists.award"])->firstOrFail();
    }

    public function addAwardToOscar(string $year, string $awardArtistId)
    {
        $oscar = $this->findOscarByYear($year);
        $awardArtist = AwardArtist::findOrFail($awardArtistId);

        $oscar->awardArtists()->attach($awardArtist->id, ["id" => Str::uuid(), "created_at" => now(), "updated_at" => now()], false);
        return $oscar->with(["awardArtists"])->get();
    }

    public function removeAwardFromOscar(string $year, string $awardArtistId)
    {
        $oscar = $this->findOscarByYear($year);
        $awardArtist = AwardArtist::findOrFail($awardArtistId);
        $pivotTable = $oscar->awardArtists()->find($awardArtist->id);

        if(!$pivotTable) {
            throw new RelationNotExistsException("This award doesn't exist in the ceremony.", 500);
        }

        $oscar->awardArtists()->detach($awardArtist->id);
        return $oscar;
    }
}
