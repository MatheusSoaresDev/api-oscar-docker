<?php

namespace App\Repositories\Exceptions\Eloquent;

use App\Repositories\Contracts\ArtistExceptionInterface;
use App\Repositories\Core\Eloquent\EloquentArtistRepository;
use App\Responses\GenericException;
use App\Responses\SuccessResponse;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

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
        return SuccessResponse::handle("Ceremony has been updated.", $artist->toArray());
    }

    public function delete(string $id): JsonResponse
    {
        // TODO: Implement delete() method.
    }

    public function findById(string $id): JsonResponse
    {
        // TODO: Implement findById() method.
    }

    public function addArtistToNomineeArtist(string $artistId, string $movieId): JsonResponse
    {
        // TODO: Implement addArtistToNomineeArtist() method.
    }

    public function removeArtistFromNomineeArtist(string $artistId, string $movieId): JsonResponse
    {
        // TODO: Implement removeArtistFromNomineeArtist() method.
    }

}
