<?php

namespace App\Repositories\Exceptions\Eloquent;

use App\Repositories\Contracts\OscarExceptionInterface;
use App\Repositories\Core\Eloquent\EloquentOscarRepository;
use App\Responses\ErrorResponse;
use App\Responses\SuccessResponse;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class EloquentOscarException extends BaseEloquentException implements OscarExceptionInterface
{
    public function repository(): string
    {
        return EloquentOscarRepository::class;
    }

    public function store(array $data): JsonResponse
    {
        $oscar = $this->repository->store($data);
        return SuccessResponse::handle("Ceremony has been registered.", $oscar->toArray());
    }

    public function findAll(): JsonResponse
    {
        $oscars = $this->repository->findAll();
        return SuccessResponse::handle("All ceremonies have been found.", $oscars->toArray());
    }

    public function update(string $year, array $data): JsonResponse
    {
        $oscar = $this->repository->update($year, $data);
        return SuccessResponse::handle("Ceremony has been updated.", $oscar->toArray());
    }

    public function delete(string $year):JsonResponse
    {
        $this->repository->delete($year);
        return SuccessResponse::handle("Ceremony has been deleted.");
    }

    public function findById(string $id):JsonResponse
    {
        $oscar = $this->repository->findById($id);
        return SuccessResponse::handle("The ceremony has been found.", $oscar->toArray());
    }

    public function findOscarByYear(int $year):JsonResponse
    {
        $oscar = $this->repository->findOscarByYear($year);
        return SuccessResponse::handle("The ceremony has been found.", $oscar->toArray());
    }
}
