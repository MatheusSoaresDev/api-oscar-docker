<?php

namespace App\Repositories\Exceptions\Eloquent;

use App\Repositories\Contracts\ArtistExceptionInterface;
use App\Repositories\Core\Eloquent\EloquentArtistRepository;
use App\Responses\CustomErrorResponse;
use App\Responses\ErrorResponse;
use App\Responses\SuccessResponse;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class EloquentArtistException extends BaseEloquentException implements ArtistExceptionInterface
{
    public function repository(): string
    {
        return EloquentArtistRepository::class;
    }
    public function store(array $data): JsonResponse
    {
        $artist = $this->repository->store($data);
        return SuccessResponse::handle("Artist has been registered.", $artist->toArray());
    }

    public function update(string $id, array $data): JsonResponse
    {
        $artist = $this->repository->update($id, $data);
        return SuccessResponse::handle("Artist has been updated.", $artist->toArray());
    }

    public function delete(string $id): JsonResponse
    {
        $this->repository->delete($id);
        return SuccessResponse::handle("Artist has been deleted.");
    }

    public function findById(string $id): JsonResponse
    {
        $artist = $this->repository->findById($id);
        return SuccessResponse::handle("Artist has been found.", $artist->toArray());
    }

    public function addNomineeArtistToOscar(string $yearOscar, array $data): JsonResponse
    {
        $this->repository->addNomineeArtistToOscar($yearOscar, $data);
        return SuccessResponse::handle("Nominee has been registered to this award.");
    }

    public function removeNomineeArtistFromOscar(string $yearOscar, array $data): JsonResponse
    {
        $this->repository->removeNomineeArtistFromOscar($yearOscar, $data);
        return SuccessResponse::handle("Nominee has been deleted from the ceremony");
    }

    public function nomineeWinnerOrNoWinner(string $yearOscar, array $data): JsonResponse
    {
        $this->repository->nomineeWinnerOrNoWinner($yearOscar, $data);
        return SuccessResponse::handle("Nominee has been updated to winner.");
    }
}
