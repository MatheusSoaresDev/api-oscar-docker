<?php

namespace App\Repositories\Contracts;
use Illuminate\Http\JsonResponse;

interface MovieExceptionInterface
{
    public function getRateInSiteRating():JsonResponse;
}
