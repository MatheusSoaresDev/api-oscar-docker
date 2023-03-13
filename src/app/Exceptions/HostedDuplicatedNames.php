<?php

namespace App\Exceptions;

use Exception;

class HostedDuplicatedNames extends Exception
{
    public function handle()
    {
        return response()->json([
            "timestamp" => now(),
            "status" => 500,
            "message" => $this->getMessage(),

        ], $this->getCode());
    }
}
