<?php

namespace App\Repositories\Core\Eloquent;

use App\Models\Movie;
use App\Models\OscarAwardArtist;
use App\Models\OscarAwardMovie;
use App\Repositories\Contracts\MovieRepositoryInterface;
use App\Repositories\Contracts\OscarRepositoryInterface;
use App\Repositories\Core\Eloquent\Verifications\NomineeMovieVerification;
use Illuminate\Support\Str;

class EloquentMovieRepository extends BaseEloquentRepository implements MovieRepositoryInterface
{
    private OscarRepositoryInterface $oscar;
    private NomineeMovieVerification $verify;

    public function __construct(OscarRepositoryInterface $oscar, NomineeMovieVerification $verify)
    {
        parent::__construct();
        $this->oscar = $oscar;
        $this->verify = $verify;
    }

    public function entity(): string
    {
        return Movie::class;
    }

    public function addNomineeMovieToOscar(string $yearOscar, array $data):void
    {
        $oscarAward = $this->getOscarAwardMovie($yearOscar, $data["awardMovieId"]);

        $this->verify->verifyIfExistsItAwardInCeremony($oscarAward);
        $this->verify->verifyIfMovieIsAlreadyNominee($oscarAward, $data);

        $oscarAward->nomineeMoviesRelation()->attach($data["movieId"],
            ["id" => Str::uuid(), "movie_id" => $data["movieId"], "winner" => $data["winner"], "created_at" => now(), "updated_at" => now()], false);
    }

    public function removeNomineeMovieFromOscar(string $yearOscar, array $data):void
    {
        $oscarAward = $this->getOscarAwardMovie($yearOscar, $data["awardMovieId"]);

        $this->verify->verifyIfExistsItAwardInCeremony($oscarAward);
        $this->verify->verifyIfExistsNominee($oscarAward, $data);

        $oscarAward->nomineeMoviesRelation()->detach($data["movieId"]);
    }

    public function nomineeWinnerOrNoWinner(string $yearOscar, array $data):void
    {
        // TODO: Implement nomineeWinnerOrNoWinner() method.
    }

    public function getRateInSiteRating()
    {
        // TODO: Implement getRateInSiteRating() method.
    }

    private function getOscarAwardMovie(string $yearOscar, $awardMovieId): OscarAwardMovie
    {
        $oscarId = $this->oscar->findOscarByYear($yearOscar)->id;
        return OscarAwardMovie::where("awardmovie_id", $awardMovieId)->where("oscar_id", $oscarId)->first();
    }
}
