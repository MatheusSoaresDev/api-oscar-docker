<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateArtistRequest;
use App\Http\Requests\FindByIdArtistRequest;
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

    public function addNomineeArtistToOscar(Request $request, int $year): JsonResponse
    {
        $data = $request->only(["awardArtistId", "artistId", "movieId"]);
        return $this->exception->addNomineeArtistToOscar($year, $data);
    }
}
