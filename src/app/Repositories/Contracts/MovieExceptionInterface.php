<?php

namespace App\Repositories\Contracts;
use Illuminate\Http\JsonResponse;

interface MovieExceptionInterface
{
    public function addNomineeMovieToOscar(string $yearOscar, array $data): JsonResponse;
    public function removeNomineeMovieFromOscar(string $yearOscar, array $data): JsonResponse;
    public function nomineeWinnerOrNoWinner(string $yearOscar, array $data):JsonResponse;
    public function getRateInSiteRating():JsonResponse;
}
