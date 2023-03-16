<?php

namespace App\Repositories\Exceptions\Eloquent;

use App\Exceptions\Exception;
use App\Exceptions\OscarQueryEditionException;
use App\Repositories\Contracts\AwardArtistExceptionInterface;
use App\Repositories\Core\Eloquent\EloquentAwardArtistRepository;
use App\Responses\GenericException;
use App\Responses\NotFoundRequest;
use App\Responses\SuccessRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
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
        try {
            DB::beginTransaction();
            $oscar = $this->repository->store($data);
            DB::commit();

            return SuccessRequest::handle("Award has been registered.", $oscar->toArray());
        } catch(Exception $e){
            DB::rollBack();
            return GenericException::handle($e);
        }
    }

    public function findById(string $id): JsonResponse
    {
        try {
            $oscar = $this->repository->findById($id);
            return SuccessRequest::handle("Award has been found.", $oscar->toArray());
        } catch(ModelNotFoundException $e){
            return NotFoundRequest::handle($e, "id", $id, "Award hasn't been found with id: %s");
        }
    }

    public function update(string $id, array $data): JsonResponse
    {
        try {
            DB::beginTransaction();
            $oscar = $this->repository->update($id, $data);
            DB::commit();

            return SuccessRequest::handle("Ceremony has been updated.", $oscar->toArray());
        } catch(OscarQueryEditionException $e){
            DB::rollBack();
            return $e->handle("edition", $data["edition"], $e->getMessage());
        }
    }

    public function delete(string $id): JsonResponse
    {
        try {
            DB::beginTransaction();
            $this->repository->delete($id);
            DB::commit();

            return SuccessRequest::handle("Award has been deleted.");
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            return NotFoundRequest::handle($e, "id", $id, "Award hasn't been found with id: %s");
        }
    }

    public function bindOscarAwardArtist(array $data): JsonResponse
    {
        // TODO: Implement bindOscarAwardArtist() method.
    }
}
