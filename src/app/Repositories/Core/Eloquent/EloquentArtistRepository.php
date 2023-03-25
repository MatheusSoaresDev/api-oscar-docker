<?php

namespace App\Repositories\Core\Eloquent;

use App\Exceptions\NomineeArtistAlreadyExistsException;
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
        $artist = $this->findById($data["artistId"]);
        $oscarAward = OscarAwardArtist::where("awardartist_id", $data["awardArtistId"])->firstOrFail();
        $pivotTable = $oscarAward->nomineeArtistsRelation()->where("artist_id", $artist->id)->where("movie_id", $data["movieId"])->first();

        if($pivotTable) {
            throw new NomineeArtistAlreadyExistsException("The artist is already nominated for the ceremony.", 500);
        }

        $oscarAward->nomineeArtists()->attach($data["artistId"], ["id" => Str::uuid(), "movie_id" => $data["movieId"], "created_at" => now(), "updated_at" => now()], false);
    }

    public function removeNomineeArtistFromOscar(string $yearOscar, array $data)
    {
        $oscarAward = $this->oscar->findOscarByYear($yearOscar)->awards_artists->where("awardartist_id", $data["awardArtistId"])->firstOrFail();
        $oscarAward->nomineeArtists()->detach($data["artistId"]);
    }
}
