<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddAwardToOscarRequest;
use App\Http\Requests\CreateOscarRequest;
use App\Http\Requests\DeleteOscarByYearRequest;
use App\Http\Requests\FindOscarByYearRequest;
use App\Http\Requests\RemoveAwardFromOscarRequest;
use App\Http\Requests\UpdateOscarRequest;
use App\Repositories\Contracts\OscarExceptionInterface;
use Illuminate\Http\JsonResponse;

class OscarController extends Controller
{
    private OscarExceptionInterface $exception;
    public function __construct(OscarExceptionInterface $exception)
    {
        $this->exception = $exception;
    }

    public function store(CreateOscarRequest $request): JsonResponse
    {
        $data = $request->only(["year", "edition", "local", "date", "city", "hosts", "curiosities"]);
        return $this->exception->store($data);
    }

    public function findOscarByYear(FindOscarByYearRequest $request, int $year): JsonResponse
    {
        return $this->exception->findOscarByYear($year);
    }

    public function update(UpdateOscarRequest $request, int $year)
    {
        $data = $request->only(["year", "edition", "local", "date", "city", "hosts", "curiosities"]);
        return $this->exception->update($year, $data);
    }

    public function delete(DeleteOscarByYearRequest $request, int $year): JsonResponse
    {
        return $this->exception->delete($year);
    }

    public function addAwardToOscar(AddAwardToOscarRequest $request, string $year, string $awardArtistId):JsonResponse
    {
        return $this->exception->addAwardToOscar($year, $awardArtistId);
    }

    public function removeAwardFromOscar(RemoveAwardFromOscarRequest $request, string $year, string $awardArtistId):JsonResponse
    {
        return $this->exception->removeAwardFromOscar($year, $awardArtistId);
    }
}
