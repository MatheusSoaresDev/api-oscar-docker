<?php

namespace App\Repositories\Core\Eloquent\Verifications;

use App\Exceptions\ArtistNotIsNomineeWithDuplicateMovieException;
use App\Exceptions\ExistsItAwardInCeremonyException;
use App\Exceptions\NomineeArtistAlreadyExistsException;
use App\Exceptions\NomineeIsNotExistsException;
use App\Models\OscarAwardMovie;

class NomineeMovieVerification
{
    public function verifyIfMovieIsAlreadyNominee(OscarAwardMovie $oscarAward, array $data): void
    {
        $verify = $oscarAward->nomineeMovies()->where("movie_id", $data["movieId"])->where("oscarawardmovie_id", $oscarAward->id)->first();
        if ($verify) {
            throw new NomineeArtistAlreadyExistsException("This movie is already nominated for this award in its ceremony", 500);
        }
    }

    public function verifyIfExistsItAwardInCeremony($oscarAward): void
    {
        if (!$oscarAward) {
            throw new ExistsItAwardInCeremonyException("This award doesn't exist in the ceremony.", 500);
        }
    }

    /*public function verifyIfMovieNotIsNomineeWithDuplicateMovie(OscarAwardMovie $oscarAward, array $data): void
    {
        $verify = $oscarAward->nomineeArtists()->where("movie_id", $data["movieId"])->where("oscarawardmovie_id", $oscarAward->id)->first();
        if ($verify) {
            throw new ArtistNotIsNomineeWithDuplicateMovieException("The movie can't have two artists nominated for the same award.", 500);
        }
    }*/

    public function verifyIfExistsNominee(OscarAwardMovie $oscarAward, array $data): void
    {
        $verify = $oscarAward->nomineeMovies()->where("movie_id", $data["movieId"])->where("oscarawardmovie_id", $oscarAward->id)->first();
        if (!$verify) {
            throw new NomineeIsNotExistsException("Nominee hasn't been found.", 500);
        }
    }
}
