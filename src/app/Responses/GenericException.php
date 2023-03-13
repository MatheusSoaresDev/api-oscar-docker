<?php

namespace App\Responses;

use App\Responses\Contracts\ResponseInterface;
use Illuminate\Http\JsonResponse;

class GenericException
{
    public static function handle(\Throwable $e, array $details = null): JsonResponse
    {
        return response()->json([
            "timestamp" => now(),
            "status" => 500,
            "error" => $e->getMessage(),
            "details" => [
            ]
        ], 500);
    }
}
