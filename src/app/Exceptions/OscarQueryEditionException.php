<?php

namespace App\Exceptions;

use App\Responses\ErrorResponse;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OscarQueryEditionException extends Exception
{
    public function render(Request $request): JsonResponse
    {
        return ErrorResponse::handle($this, [
            "field" => "edition",
            "value" => $request->get("edition"),
            "message" => sprintf($this->getMessage(), $request->get("edition"))
        ]);
    }
}
