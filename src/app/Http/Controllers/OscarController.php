<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOscarRequest;
use App\Repositories\Exceptions\OscarExceptions;
use Illuminate\Http\JsonResponse;

class OscarController extends Controller
{
    private $exception;
    public function __construct(OscarExceptions $exception)
    {
        $this->exception = $exception;
    }

    public function store(CreateOscarRequest $request): JsonResponse
    {
        $data = $request->only(["year", "edition", "local", "date", "city", "hosts", "curiosities"]);
        return $this->exception->store($data);
    }

    public function get(int $year): JsonResponse
    {
        return $this->exception->findOscarByYear($year);
    }
}
