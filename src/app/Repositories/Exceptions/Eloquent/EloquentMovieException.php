<?php

namespace App\Repositories\Exceptions\Eloquent;

use App\Repositories\Contracts\MovieExceptionInterface;
use App\Repositories\Core\Eloquent\EloquentMovieRepository;
use App\Responses\SuccessResponse;
use Illuminate\Http\JsonResponse;

class EloquentMovieException extends BaseEloquentException implements MovieExceptionInterface
{
    public function repository(): string
    {
        return EloquentMovieRepository::class;
    }

    public function store(array $data): JsonResponse
    {
        $movie = $this->repository->store($data);
        return SuccessResponse::handle("Movie has been registered.", $movie->toArray());
    }

    public function update(string $id, array $data): JsonResponse
    {
        $movie = $this->repository->update($id, $data);
        return SuccessResponse::handle("Movie has been registered.", $movie->toArray());
    }

    public function findById(string $id): JsonResponse
    {
        $movie = $this->repository->findById($id);
        return SuccessResponse::handle("Award has been found.", $movie->toArray());
    }

    public function delete(string $id): JsonResponse
    {
        // TODO: Implement delete() method.
    }

    public function addNomineeMovieToOscar(string $yearOscar, array $data): JsonResponse
    {
        $this->repository->addNomineeMovieToOscar($yearOscar, $data);
        return SuccessResponse::handle("Nominee has been registered to this award.");
    }

    public function removeNomineeMovieFromOscar(string $yearOscar, array $data): JsonResponse
    {
        $this->repository->removeNomineeMovieFromOscar($yearOscar, $data);
        return SuccessResponse::handle("Nominee has been deleted from the ceremony");
    }

    public function nomineeWinnerOrNoWinner(string $yearOscar, array $data): JsonResponse
    {
        $this->repository->nomineeWinnerOrNoWinner($yearOscar, $data);
        return SuccessResponse::handle("Nominee has been updated to winner.");
    }

    public function getRateInSiteRating(): JsonResponse
    {
        // TODO: Implement getRateInSiteRating() method.
    }
}

