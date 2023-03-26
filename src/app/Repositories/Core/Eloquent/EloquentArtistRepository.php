<?php

namespace App\Repositories\Core\Eloquent;

use App\Models\Artist;
use App\Models\OscarAwardArtist;
use App\Repositories\Contracts\ArtistRepositoryInterface;
use App\Repositories\Contracts\OscarRepositoryInterface;
use App\Repositories\Core\Eloquent\Verifications\NomineeArtistVerification;
use Illuminate\Support\Str;

class EloquentArtistRepository extends BaseEloquentRepository implements ArtistRepositoryInterface
{
    private OscarRepositoryInterface $oscar;
    private NomineeArtistVerification $verify;

    public function __construct(OscarRepositoryInterface $oscar, NomineeArtistVerification $verify)
    {
        parent::__construct();
        $this->oscar = $oscar;
        $this->verify = $verify;
    }

    public function entity(): string
    {
        return Artist::class;
    }

    public function addNomineeArtistToOscar(string $yearOscar, array $data):void
    {
        $oscarId = $this->oscar->findOscarByYear($yearOscar)->id;
        $oscarAward = OscarAwardArtist::where("awardartist_id", $data["awardArtistId"])->where("oscar_id", $oscarId)->first();

        $this->verify->verifyIfExistsItAwardInCeremony($oscarAward);
        $this->verify->verifyIfArtistIsAlreadyNominee($oscarAward, $data);
        $this->verify->verifyIfArtistNotIsNomineeWithDuplicateMovie($oscarAward, $data);

        $oscarAward->nomineeArtistsRelation()->attach($data["artistId"], ["id" => Str::uuid(), "movie_id" => $data["movieId"], "created_at" => now(), "updated_at" => now()], false);
    }

    public function removeNomineeArtistFromOscar(string $yearOscar, array $data):void
    {
        $oscarId = $this->oscar->findOscarByYear($yearOscar)->id;
        $oscarAward = OscarAwardArtist::where("awardartist_id", $data["awardArtistId"])->where("oscar_id", $oscarId)->first();

        $this->verify->verifyIfExistsItAwardInCeremony($oscarAward);
        $this->verify->verifyIfExistsNominee($oscarAward, $data);

        $oscarAward->nomineeArtistsRelation()->detach($data["artistId"]);
    }
}
