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
        try {
            DB::beginTransaction();
            $oscar = $this->repository->store($data);
            DB::commit();

            return SuccessResponse::handle("Ceremony has been registered.", $oscar->toArray());
        } catch(Exception $e){
            DB::rollBack();
            return ErrorResponse::handle($e);
        }
    }

    public function update(string $year, array $data): JsonResponse
    {
        $oscar = $this->repository->update($year, $data);
        return SuccessResponse::handle("Ceremony has been updated.", $oscar->toArray());
    }

    public function delete(string $year):JsonResponse
    {
        try {
            DB::beginTransaction();
            $this->repository->delete($year);
            DB::commit();

            return SuccessResponse::handle("Ceremony has been deleted.");
        } catch (Exception $e) {
            DB::rollBack();
            return ErrorResponse::handle($e);
        }
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
