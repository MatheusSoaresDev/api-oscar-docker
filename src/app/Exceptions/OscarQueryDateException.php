<?php

namespace App\Exceptions;

use Exception;

class OscarQueryDateException extends Exception
{
    public function handle($field = null, $value = null, $message = null)
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
