<?php

namespace App\Exceptions;
use Illuminate\Http\JsonResponse;

class Exception extends \Exception
{
    public function handle($field = null, $value = null, $message = null): JsonResponse
    {
        return response()->json([
            "timestamp" => now(),
            "status" => 500,
            "message" => $this->getMessage(),
            "details" => [
                "field" => $field,
                "value" => $value,
                "message" => sprintf($message, $value)
            ]
        ], $this->getCode());
    }
}
