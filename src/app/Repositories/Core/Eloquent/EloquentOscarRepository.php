<?php

namespace App\Repositories\Core\Eloquent;

use App\Exceptions\OscarAlreadyHasAwardArtistException;
use App\Exceptions\OscarDoesntHaveItAwardException;
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

    public function findAll()
    {
        return $this->entity->with([
            "hosts",
            "curiosities",
            "awardArtists.award",
            "awardArtists.nomineeArtists.artist",
            "awardArtists.nomineeArtists.movie"
        ])->paginate(5);
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
        return $this->entity->whereYear("date", $year)
            ->with(["hosts", "curiosities", "awardArtists.award", "awardArtists.nomineeArtists.artist", "awardArtists.nomineeArtists.movie"])
            ->firstOrFail();
    }
}
