<?php

namespace App\Responses\Contracts;

use Illuminate\Http\JsonResponse;

interface ResponseInterface
{
    public static function handle(\Throwable $e, array $details):JsonResponse;
}
