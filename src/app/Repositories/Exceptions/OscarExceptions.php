<?php

namespace App\Repositories\Exceptions;

use App\Repositories\Contracts\OscarRepositoryInterface;
use App\Responses\GenericException;
use App\Responses\NotFoundRequest;
use App\Responses\SuccessRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class OscarExceptions
{
    private OscarRepositoryInterface $repository;

    public function __construct(OscarRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function store(array $data):JsonResponse
    {
        try {
            DB::beginTransaction();
            $oscar = $this->repository->store($data);
            DB::commit();

            return SuccessRequest::handle("Ceremony has been registered.", $oscar->toArray());
        } catch(\Exception $e){
            DB::rollBack();
            return GenericException::handle($e);
        }
    }

    public function findOscarByYear(mixed $year): JsonResponse
    {
        try {
            $oscar = $this->repository->findOscarByYear($year);
            return SuccessRequest::handle("The ceremony has been found.", $oscar->toArray());
        } catch(ModelNotFoundException $e){
            return NotFoundRequest::handle($e, "year", $year, "The ceremony hasn't been found on %s");
        }
    }
}
