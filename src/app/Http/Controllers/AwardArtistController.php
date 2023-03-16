<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAwardArtistRequest;
use App\Http\Requests\UpdateAwardArtistRequest;
use App\Repositories\Contracts\AwardArtistExceptionInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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

    public function findById(string $id):JsonResponse
    {
        return $this->exception->findById($id);
    }

    public function update(UpdateAwardArtistRequest $request, string $id):JsonResponse
    {
        $data = $request->only(["name"]);
        return $this->exception->update($id, $data);
    }

    public function delete(string $id):JsonResponse
    {
        return $this->exception->delete($id);
    }
}
