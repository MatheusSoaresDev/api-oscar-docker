<?php

namespace App\Responses;

class NotFoundRequest
{
    public static function handle(\Throwable $e, $field = null, $value = null, $message = null)
    {
        $model = explode("\\", $e->getModel());

        return response()->json([
            "timestamp" => now(),
            "status" => 404,
            "message" => $model[2]." not found.",
            "details" => [
                "field" => $field,
                "value" => $value,
                "message" => sprintf($message, $value)
            ]
        ], 404);
    }
}
