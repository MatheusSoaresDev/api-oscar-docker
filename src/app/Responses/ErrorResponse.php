<?php

namespace App\Responses;

use Illuminate\Http\JsonResponse;

class ErrorResponse
{
    public static function handle(\Throwable $e, array $content = [], int $code = 500): JsonResponse
    {
        return response()->json([
            "timestamp" => now(),
            "status" => $e->getCode() == 0 ? $code : $e->getCode(),
            "message" => $e->getMessage(),
            "details" => [
                $content
            ]
        ], $e->getCode() == 0 ? $code : $e->getCode());
    }
}
