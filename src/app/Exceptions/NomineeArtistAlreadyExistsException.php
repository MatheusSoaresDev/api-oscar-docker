<?php

namespace App\Exceptions;

use App\Responses\ErrorResponse;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NomineeArtistAlreadyExistsException extends Exception
{
    public function render(Request $request): JsonResponse
    {
        return ErrorResponse::handle($this, /*[
            "fields" => [
                "year",
                "awardArtistId",
                "artistId",
                "movieId"
            ],
            "values" => [
                $request->route("year"),
                $request->route("awardArtistId"),
                $request->route("artistId"),
                $request->route("movieId")
            ],
        ]*/);
    }
}
