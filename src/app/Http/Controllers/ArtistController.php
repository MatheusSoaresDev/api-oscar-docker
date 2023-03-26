<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddNomineeArtistToOscarRequest;
use App\Http\Requests\CreateArtistRequest;
use App\Http\Requests\FindByIdArtistRequest;
use App\Http\Requests\NomineeWinnerOrNoWinnerRequest;
use App\Http\Requests\RemoveNomineeArtistFromOscarRequest;
use App\Http\Requests\UpdateArtistRequest;
use App\Repositories\Contracts\ArtistExceptionInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    private ArtistExceptionInterface $exception;

    public function __construct(ArtistExceptionInterface $exception)
    {
        $this->exception = $exception;
    }

    public function store(CreateArtistRequest $request): JsonResponse
    {
        $data = $request->only(["name", "birth", "birthplace", "country", "wikipedia"]);
        return $this->exception->store($data);
    }

    public function findById(FindByIdArtistRequest $request, string $id): JsonResponse
    {
        return $this->exception->findById($id);
    }

    public function update(UpdateArtistRequest $request, string $id): JsonResponse
    {
        $data = $request->only(["name", "birth", "birthplace", "country", "wikipedia"]);
        return $this->exception->update($id, $data);
    }

    public function addNomineeArtistToOscar(AddNomineeArtistToOscarRequest $request, int $year): JsonResponse
    {
        $data = $request->only(["awardArtistId", "artistId", "movieId", "winner"]);
        return $this->exception->addNomineeArtistToOscar($year, $data);
    }

    public function removeNomineeArtistFromOscar(RemoveNomineeArtistFromOscarRequest $request, int $year): JsonResponse
    {
        $data = $request->only(["awardArtistId", "artistId"]);
        return $this->exception->removeNomineeArtistFromOscar($year, $data);
    }

    public function nomineeWinnerOrNoWinner(NomineeWinnerOrNoWinnerRequest $request, int $year): JsonResponse
    {
        $data = $request->only(["awardArtistId", "artistId", "winner"]);
        return $this->exception->nomineeWinnerOrNoWinner($year, $data);
    }
}
