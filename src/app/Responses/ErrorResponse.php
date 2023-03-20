<?php

namespace App\Responses;

use Illuminate\Http\JsonResponse;

class ErrorResponse
{
    public static function handle(\Throwable $e, array $content = []): JsonResponse
    {
        return response()->json([
            "timestamp" => now(),
            "status" => $e->getCode(),
            "message" => $e->getMessage(),
            "details" => [
                $content
            ]
        ], $e->getCode());
    }
}
