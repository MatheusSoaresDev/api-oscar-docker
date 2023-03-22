<?php

namespace App\Repositories\Exceptions\Eloquent;

use App\Repositories\Contracts\AwardArtistExceptionInterface;
use App\Repositories\Core\Eloquent\EloquentAwardArtistRepository;
use App\Responses\SuccessResponse;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class EloquentAwardArtistException extends BaseEloquentException implements AwardArtistExceptionInterface
{
    public function repository(): string
    {
        return EloquentAwardArtistRepository::class;
    }

    public function store(array $data): JsonResponse
    {
        $awardArtist = $this->repository->store($data);
        return SuccessResponse::handle("Award has been registered.", $awardArtist->toArray());
    }

    public function findById(string $id): JsonResponse
    {
        $oscar = $this->repository->findById($id);
        return SuccessResponse::handle("Award has been found.", $oscar->toArray());
    }

    public function update(string $id, array $data): JsonResponse
    {
        $awardArtist = $this->repository->update($id, $data);
        return SuccessResponse::handle("Award artist has been updated.", $awardArtist->toArray());
    }

    public function delete(string $id): JsonResponse
    {
        $this->repository->delete($id);
        return SuccessResponse::handle("Award has been deleted.");
    }

    public function findAwardArtistByName(string $name): JsonResponse
    {
        // TODO: Implement findAwardArtistByName() method.
    }

    public function addAwardToOscar(string $year, string $awardArtistId):JsonResponse
    {
        $attach = $this->repository->addAwardToOscar($year, $awardArtistId);
        return SuccessResponse::handle("The award has been added to the ceremony.", $attach->toArray());
    }

    public function removeAwardFromOscar(string $year, string $awardArtistId):JsonResponse
    {
        $this->repository->removeAwardFromOscar($year, $awardArtistId);
        return SuccessResponse::handle("The award has been removed from the ceremony.");
    }
}
