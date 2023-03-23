<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMovieRequest;
use App\Http\Requests\FindByIdMovieRequest;
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
}
