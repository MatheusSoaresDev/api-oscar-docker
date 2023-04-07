<?php

namespace App\Http\Controllers;

use App\Http\Requests\AwardMovieFindByIdRequest;
use App\Http\Requests\CreateAwardMovieRequest;
use App\Repositories\Contracts\AwardArtistExceptionInterface;
use App\Repositories\Contracts\AwardMovieExceptionInterface;
use Illuminate\Http\JsonResponse;

class AwardMovieController extends Controller
{
    private AwardMovieExceptionInterface $exception;

    public function __construct(AwardMovieExceptionInterface $exception)
    {
        $this->exception = $exception;
    }

    public function store(CreateAwardMovieRequest $request):JsonResponse
    {
        $data = $request->only(["name"]);
        return $this->exception->store($data);
    }

    public function findById(AwardMovieFindByIdRequest $request, string $id):JsonResponse
    {
        return $this->exception->findById($id);
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
