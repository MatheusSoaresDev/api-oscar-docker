<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddAwardArtistToOscarRequest;
use App\Http\Requests\AwardArtistFindByIdRequest;
use App\Http\Requests\CreateAwardArtistRequest;
use App\Http\Requests\DeleteAwardArtistByYearRequest;
use App\Http\Requests\RemoveAwardArtistFromOscarRequest;
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

    public function addAwardToOscar(AddAwardArtistToOscarRequest $request, string $year, string $awardArtistId):JsonResponse
    {
        return $this->exception->addAwardToOscar($year, $awardArtistId);
    }

    public function removeAwardFromOscar(RemoveAwardArtistFromOscarRequest $request, string $year, string $awardArtistId):JsonResponse
    {
        return $this->exception->removeAwardFromOscar($year, $awardArtistId);
    }
}
