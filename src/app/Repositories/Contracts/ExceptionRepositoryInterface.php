<?php

namespace App\Repositories\Contracts;

use Illuminate\Http\JsonResponse;

interface ExceptionRepositoryInterface
{
    public function store(array $data):JsonResponse;
    public function update(string $id, array $data):JsonResponse;
    public function delete(string $id):JsonResponse;
    public function findById(string $id):JsonResponse;
}
