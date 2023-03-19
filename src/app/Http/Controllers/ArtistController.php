<?php

namespace App\Http\Controllers;

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

    public function store(Request $request): JsonResponse
    {
        $data = $request->only(["name", "birth", "birthplace", "country", "wikipedia"]);
        return $this->exception->store($data);
    }
}
