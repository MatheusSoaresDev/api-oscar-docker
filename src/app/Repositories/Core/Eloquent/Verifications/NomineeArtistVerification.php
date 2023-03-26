<?php

namespace App\Repositories\Core\Eloquent\Verifications;

use App\Exceptions\ArtistNotIsNomineeWithDuplicateMovieException;
use App\Exceptions\ExistsItAwardInCeremonyException;
use App\Exceptions\NomineeArtistAlreadyExistsException;
use App\Exceptions\NomineeIsNotExistsException;
use App\Models\OscarAwardArtist;

class NomineeArtistVerification
{

    public function verifyIfArtistIsAlreadyNominee(OscarAwardArtist $oscarAward, array $data): void
    {
        $verify = $oscarAward->nomineeArtists()->where("artist_id", $data["artistId"])->where("oscarawardartist_id", $oscarAward->id)->first();
        if ($verify) {
            throw new NomineeArtistAlreadyExistsException("This artist is already nominated for this award in its ceremony", 500);
        }
    }

    public function verifyIfExistsItAwardInCeremony($oscarAward): void
    {
        if (!$oscarAward) {
            throw new ExistsItAwardInCeremonyException("This award doesn't exist in the ceremony.", 500);
        }
    }

    public function verifyIfArtistNotIsNomineeWithDuplicateMovie(OscarAwardArtist $oscarAward, array $data): void
    {
        $verify = $oscarAward->nomineeArtists()->where("movie_id", $data["movieId"])->where("oscarawardartist_id", $oscarAward->id)->first();
        if ($verify) {
            throw new ArtistNotIsNomineeWithDuplicateMovieException("The movie can't have two artists nominated for the same award.", 500);
        }
    }

    public function verifyIfExistsNominee(OscarAwardArtist $oscarAward, array $data): void
    {
        $verify = $oscarAward->nomineeArtists()->where("artist_id", $data["artistId"])->where("oscarawardartist_id", $oscarAward->id)->first();
        if (!$verify) {
            throw new NomineeIsNotExistsException("Nominee hasn't been found.", 500);
        }
    }
}
