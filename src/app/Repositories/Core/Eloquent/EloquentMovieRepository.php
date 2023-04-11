<?php

namespace App\Repositories\Core\Eloquent;

use App\Exceptions\NomineeIsAlreadyWinner;
use App\Models\{OscarAwardMovie, Movie};
use App\Repositories\Contracts\{MovieRepositoryInterface, OscarRepositoryInterface};
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
        $oscarAward = $this->getOscarAwardMovie($yearOscar, $data["awardMovieId"]);
        $winner = $data["winner"] ? "winner" : "noWinner";

        $this->verify->verifyIfExistsItAwardInCeremony($oscarAward);
        $this->verify->verifyIfExistsNominee($oscarAward, $data);

        $nominee = $oscarAward->nomineeMovies()->where("movie_id", $data["movieId"])->first();
        $nominee->winner = $data["winner"];

        if(!$nominee->isDirty()){
            throw new NomineeIsAlreadyWinner(Movie::NOMINEE_WINNER_MESSAGE[$winner]);
        }
        $nominee->save();
    }

    private function getOscarAwardMovie(string $yearOscar, $awardMovieId): OscarAwardMovie
    {
        $oscarId = $this->oscar->findOscarByYear($yearOscar)->id;
        return OscarAwardMovie::where("awardmovie_id", $awardMovieId)->where("oscar_id", $oscarId)->first();
    }
}
