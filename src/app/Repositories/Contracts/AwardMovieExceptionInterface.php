<?php

namespace App\Repositories\Contracts;

use Illuminate\Http\JsonResponse;

interface AwardMovieExceptionInterface
{
    public function store(array $data): JsonResponse;
    public function findById(string $id): JsonResponse;
    public function update(string $id, array $data): JsonResponse;
    public function addAwardToOscar(string $year, string $awardMovieId): JsonResponse;
    public function removeAwardFromOscar(string $year, string $awardMovieId): JsonResponse;
}
