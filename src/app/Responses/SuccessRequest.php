<?php

namespace App\Responses;

use App\Responses\Contracts\ResponseInterface;
use Illuminate\Http\JsonResponse;

class SuccessRequest
{
    public static function handle(string $message, array $response = null): JsonResponse
    {
        return response()->json([
            "timestamp" => now(),
            "status" => 200,
            "message" => $message,
            "data" => [
                $response ?? null
            ]
        ], 200);
    }
}
