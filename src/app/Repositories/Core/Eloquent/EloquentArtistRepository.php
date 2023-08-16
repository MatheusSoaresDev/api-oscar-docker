<?php

namespace App\Repositories\Core\Eloquent;

use App\Exceptions\ArtistNotIsNomineeWithDuplicateMovieException;
use App\Exceptions\ExistsItAwardInCeremonyException;
use App\Exceptions\NomineeArtistAlreadyExistsException;
use App\Exceptions\NomineeIsAlreadyWinner;
use App\Exceptions\NomineeIsNotExistsException;
use App\Models\{Artist, OscarAwardArtist};
use App\Repositories\Contracts\{ArtistRepositoryInterface, OscarRepositoryInterface};
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

    /**
     * @throws ExistsItAwardInCeremonyException
     * @throws ArtistNotIsNomineeWithDuplicateMovieException
     * @throws NomineeArtistAlreadyExistsException
     */
    public function addNomineeArtistToOscar(string $yearOscar, array $data):void
    {
        $oscarAward = $this->getOscarAwardArtist($yearOscar, $data["awardArtistId"]);

        $this->verify->verifyIfExistsItAwardInCeremony($oscarAward);
        $this->verify->verifyIfArtistIsAlreadyNominee($oscarAward, $data);
        $this->verify->verifyIfArtistNotIsNomineeWithDuplicateMovie($oscarAward, $data);

        $oscarAward->nomineeArtistsRelation()->attach($data["artistId"],
            ["id" => Str::uuid(), "movie_id" => $data["movieId"], "winner" => $data["winner"], "created_at" => now(), "updated_at" => now()],
            false);
    }

    /**
     * @throws ExistsItAwardInCeremonyException
     * @throws NomineeIsNotExistsException
     */
    public function removeNomineeArtistFromOscar(string $yearOscar, array $data):void
    {
        $oscarAward = $this->getOscarAwardArtist($yearOscar, $data["awardArtistId"]);
        $this->verify->verifyIfExistsItAwardInCeremony($oscarAward);
        $this->verify->verifyIfExistsNominee($oscarAward, $data);

        $oscarAward->nomineeArtistsRelation()->detach($data["artistId"]);
    }

    public function nomineeWinnerOrNoWinner(string $yearOscar, array $data):void
    {
        $oscarAward = $this->getOscarAwardArtist($yearOscar, $data["awardArtistId"]);
        $winner = $data["winner"] ? "winner" : "noWinner";

        $this->verify->verifyIfExistsItAwardInCeremony($oscarAward);
        $this->verify->verifyIfExistsNominee($oscarAward, $data);

        $nominee = $oscarAward->nomineeArtists()->where("artist_id", $data["artistId"])->first();
        $nominee->winner = $data["winner"];

        if(!$nominee->isDirty()){
            throw new NomineeIsAlreadyWinner(Artist::NOMINEE_WINNER_MESSAGE[$winner]);
        }
        $nominee->save();
    }

    private function getOscarAwardArtist(string $yearOscar, $awardArtistId): OscarAwardArtist
    {
        $oscarId = $this->oscar->findOscarByYear($yearOscar)->id;
        return OscarAwardArtist::where("awardartist_id", $awardArtistId)->where("oscar_id", $oscarId)->first();
    }
}
