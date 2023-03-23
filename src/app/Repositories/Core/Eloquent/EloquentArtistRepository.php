<?php

namespace App\Repositories\Core\Eloquent;

use App\Models\Artist;
use App\Models\Oscar;
use App\Models\OscarAwardArtist;
use App\Repositories\Contracts\ArtistRepositoryInterface;
use App\Repositories\Contracts\OscarRepositoryInterface;
use Illuminate\Support\Str;

class EloquentArtistRepository extends BaseEloquentRepository implements ArtistRepositoryInterface
{
    private OscarRepositoryInterface $oscar;

    public function __construct(OscarRepositoryInterface $oscar)
    {
        parent::__construct();
        $this->oscar = $oscar;
    }

    public function entity(): string
    {
        return Artist::class;
    }

    public function addNomineeArtistToOscar(string $yearOscar, array $data):void
    {
        $oscarAward = $this->oscar->findOscarByYear($yearOscar)->awards_artists->where("awardartist_id", $data["awardArtistId"])->firstOrFail();
        $oscarAward->nomineeArtists()->attach($data["artistId"], ["id" => Str::uuid(), "movie_id" => $data["movieId"], "created_at" => now(), "updated_at" => now()], false);
    }

    public function removeNomineeArtistFromOscar(string $yearOscar, array $data)
    {
        $oscarAward = $this->oscar->findOscarByYear($yearOscar)->awards_artists->where("awardartist_id", $data["awardArtistId"])->firstOrFail();
        $oscarAward->nomineeArtists()->detach($data["artistId"]);
    }
}
