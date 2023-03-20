<?php

namespace App\Repositories\Contracts;

use Illuminate\Http\JsonResponse;
use Throwable;

interface ResponseInterface
{
    public function success(string $message, array $content):JsonResponse;
    public function error(Throwable $e, string $message, array $content, int $status):JsonResponse;
}
