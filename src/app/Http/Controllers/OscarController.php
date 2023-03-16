<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOscarRequest;
use App\Http\Requests\UpdateOscarRequest;
use App\Repositories\Contracts\OscarExceptionInterface;
use Illuminate\Http\JsonResponse;

class OscarController extends Controller
{
    private OscarExceptionInterface $exception;
    public function __construct(OscarExceptionInterface $exception)
    {
        $this->exception = $exception;
    }

    public function store(CreateOscarRequest $request): JsonResponse
    {
        $data = $request->only(["year", "edition", "local", "date", "city", "hosts", "curiosities"]);
        return $this->exception->store($data);
    }

    public function findOscarByYear(int $year): JsonResponse
    {
        return $this->exception->findOscarByYear($year);
    }

    public function update(int $year, UpdateOscarRequest $request): JsonResponse
    {
        $data = $request->only(["year", "edition", "local", "date", "city", "hosts", "curiosities"]);
        return $this->exception->update($year, $data);
    }

    public function delete(int $year): JsonResponse
    {
        return $this->exception->delete($year);
    }
}
