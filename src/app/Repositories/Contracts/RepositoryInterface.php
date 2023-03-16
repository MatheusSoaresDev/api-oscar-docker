<?php

namespace App\Repositories\Contracts;

interface RepositoryInterface
{
    public function store(array $data);
    public function update(string $id, array $data);
    public function delete(string $id);
    public function findById(string $id);
}
