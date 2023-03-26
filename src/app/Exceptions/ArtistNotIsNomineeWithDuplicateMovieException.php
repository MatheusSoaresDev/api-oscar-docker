<?php

namespace App\Exceptions;

use App\Responses\ErrorResponse;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ArtistNotIsNomineeWithDuplicateMovieException extends Exception
{
    public function render(Request $request): JsonResponse
    {
        return ErrorResponse::handle($this,/* [
            "fields" => [

            ],
            "values" => [
                //$request->route("year"),
            ],
        ]*/);
    }
}
