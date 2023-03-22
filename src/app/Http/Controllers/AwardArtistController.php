<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddAwardToOscarRequest;
use App\Http\Requests\AwardArtistFindByIdRequest;
use App\Http\Requests\CreateAwardArtistRequest;
use App\Http\Requests\DeleteAwardArtistByYearRequest;
use App\Http\Requests\RemoveAwardFromOscarRequest;
use App\Http\Requests\UpdateAwardArtistRequest;
use App\Repositories\Contracts\AwardArtistExceptionInterface;
use Illuminate\Http\JsonResponse;

class AwardArtistController extends Controller
{
    private AwardArtistExceptionInterface $exception;

    public function __construct(AwardArtistExceptionInterface $exception)
    {
        $this->exception = $exception;
    }

    public function store(CreateAwardArtistRequest $request):JsonResponse
    {
        $data = $request->only(["name"]);
        return $this->exception->store($data);
    }

    public function findById(AwardArtistFindByIdRequest $request, string $id):JsonResponse
    {
        return $this->exception->findById($id);
    }

    public function update(UpdateAwardArtistRequest $request, string $id):JsonResponse
    {
        $data = $request->only(["name"]);
        return $this->exception->update($id, $data);
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
