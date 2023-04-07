<?php

namespace App\Repositories\Exceptions\Eloquent;

use App\Repositories\Contracts\AwardMovieExceptionInterface;
use App\Repositories\Core\Eloquent\EloquentAwardMovieRepository;
use App\Responses\SuccessResponse;
use Illuminate\Http\JsonResponse;

class EloquentAwardMovieException extends BaseEloquentException implements AwardMovieExceptionInterface
{
    public function repository(): string
    {
        return EloquentAwardMovieRepository::class;
    }
    public function store(array $data): JsonResponse
    {
        $award = $this->repository->store($data);
        return SuccessResponse::handle("Award has been registered.", $award->toArray());
    }

    public function update(string $id, array $data): JsonResponse
    {
        $awardArtist = $this->repository->update($id, $data);
        return SuccessResponse::handle("Award has been updated.", $awardArtist->toArray());
    }

    public function delete(string $id): JsonResponse
    {
        $this->repository->delete($id);
        return SuccessResponse::handle("Award has been deleted.");
    }

    public function findById(string $id): JsonResponse
    {
        $award = $this->repository->findById($id);
        return SuccessResponse::handle("Award has been found.", $award->toArray());
    }

    public function addAwardToOscar(string $year, string $awardMovieId): JsonResponse
    {
        // TODO: Implement addAwardToOscar() method.
    }

    public function removeAwardFromOscar(string $year, string $awardMovieId): JsonResponse
    {
        // TODO: Implement removeAwardFromOscar() method.
    }
}
