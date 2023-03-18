<?php

namespace App\Repositories\Exceptions\Eloquent;

use App\Exceptions\OscarQueryEditionException;
use App\Exceptions\RelationNotExistsException;
use App\Repositories\Contracts\OscarExceptionInterface;
use App\Repositories\Core\Eloquent\EloquentOscarRepository;
use App\Responses\GenericException;
use App\Responses\NotFoundRequest;
use App\Responses\SuccessRequest;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
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

            return SuccessRequest::handle("Ceremony has been registered.", $oscar->toArray());
        } catch(\Exception $e){
            DB::rollBack();
            return GenericException::handle($e);
        }
    }

    public function update(string $year, array $data):JsonResponse
    {
        try {
            DB::beginTransaction();
            $oscar = $this->repository->update($year, $data);
            DB::commit();

            return SuccessRequest::handle("Ceremony has been updated.", $oscar->toArray());
        } catch(OscarQueryEditionException $e){
            DB::rollBack();
            return $e->handle("edition", $data["edition"], $e->getMessage());
        }
    }

    public function delete(string $year):JsonResponse
    {
        try {
            DB::beginTransaction();
            $this->repository->delete($year);
            DB::commit();

            return SuccessRequest::handle("Ceremony has been deleted.");
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            return NotFoundRequest::handle($e, "year", $year, "The ceremony hasn't been found on %s");
        }
    }

    public function findById(string $id):JsonResponse
    {
        try {
            $oscar = $this->repository->findById($id);
            return SuccessRequest::handle("The ceremony has been found.", $oscar->toArray());
        } catch(ModelNotFoundException $e){
            return NotFoundRequest::handle($e, "id", $id, "The ceremony hasn't been found with id: %s");
        }
    }

    public function findOscarByYear(int $year):JsonResponse
    {
        try {
            $oscar = $this->repository->findOscarByYear($year);
            return SuccessRequest::handle("The ceremony has been found.", $oscar->toArray());
        } catch(ModelNotFoundException $e){
            return NotFoundRequest::handle($e, "year", $year, "The ceremony hasn't been found on %s");
        }
    }

    public function addAwardToOscar(string $year, string $awardArtistId):JsonResponse
    {
        try {
            DB::beginTransaction();
            $attach = $this->repository->addAwardToOscar($year, $awardArtistId);
            DB::commit();

            return SuccessRequest::handle("The award has been added to the ceremony.", $attach->toArray());
        } catch(QueryException $e){
            DB::rollBack();
            return GenericException::handle($e, null, 'This award has already been added to the ceremony.');
        } catch(ModelNotFoundException $e){
            DB::rollBack();
            return NotFoundRequest::handle($e, "awardartist_id", $awardArtistId, "The award hasn't been found with id: %s");
        }
    }

    public function removeAwardFromOscar(string $year, string $awardArtistId):JsonResponse
    {
        try {
            DB::beginTransaction();
            $this->repository->removeAwardFromOscar($year, $awardArtistId);
            DB::commit();

            return SuccessRequest::handle("The award has been removed from the ceremony.");
        } catch (QueryException $e) {
            DB::rollBack();
            return GenericException::handle($e, null, 'This award has already been removed from the ceremony.');
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            return NotFoundRequest::handle($e, "awardartist_id", $awardArtistId, "The award hasn't been found with id: %s");
        } catch (RelationNotExistsException|Exception $e) {
            DB::rollBack();
            return GenericException::handle($e);
        }
    }
}
