<?php

namespace App\Responses;

use Illuminate\Http\JsonResponse;
class CustomErrorResponse
{
    public static function handle(\Throwable $e, string $message): JsonResponse
    {
        return response()->json([
            "timestamp" => now(),
            "status" => 500,
            "message" => $message ?? $e->getMessage(),
            "details" => [

            ]
        ], 500);
    }
}
