<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddNomineeMovieToOscarRequest;
use App\Http\Requests\CreateMovieRequest;
use App\Http\Requests\FindByIdMovieRequest;
use App\Http\Requests\RemoveNomineeMovieFromOscarRequest;
use App\Http\Requests\UpdateMovieRequest;
use App\Repositories\Contracts\MovieExceptionInterface;
use Illuminate\Http\JsonResponse;

class MovieController extends Controller
{
    private MovieExceptionInterface $exception;

    public function __construct(MovieExceptionInterface $exception)
    {
        $this->exception = $exception;
    }
    public function store(CreateMovieRequest $request): JsonResponse
    {
        $data = $request->only(["name", "runtime", "release", "language", "country" , "company", "wikipedia"]);
        return $this->exception->store($data);
    }

    public function findById(FindByIdMovieRequest $request, string $id): JsonResponse
    {
        return $this->exception->findById($id);
    }

    public function update(UpdateMovieRequest $request, string $id): JsonResponse
    {
        $data = $request->only(["name", "runtime", "release", "language", "country" , "company", "wikipedia"]);
        return $this->exception->update($id, $data);
    }

    public function addNomineeMovieToOscar(AddNomineeMovieToOscarRequest $request, int $year): JsonResponse
    {
        $data = $request->only(["awardMovieId", "movieId", "winner"]);
        return $this->exception->addNomineeMovieToOscar($year, $data);
    }

    public function removeNomineeMovieFromOscar(RemoveNomineeMovieFromOscarRequest $request, int $year): JsonResponse
    {
        $data = $request->only(["awardMovieId", "movieId"]);
        return $this->exception->removeNomineeMovieFromOscar($year, $data);
    }

    public function nomineeWinnerOrNoWinner(NomineeWinnerOrNoWinnerRequest $request, int $year): JsonResponse
    {
        $data = $request->only(["awardArtistId", "artistId", "winner"]);
        return $this->exception->nomineeWinnerOrNoWinner($year, $data);
    }
}
