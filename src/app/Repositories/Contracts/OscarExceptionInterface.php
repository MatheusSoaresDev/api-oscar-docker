<?php

namespace App\Repositories\Contracts;

use Illuminate\Http\JsonResponse;

interface OscarExceptionInterface
{
    public function findOscarByYear(int $year):JsonResponse;

}
