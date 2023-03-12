<?php

interface RepositoryInterface
{
    public function store(array $data);
    public function update(string $id, array $data);
    public function delete(string $id);
    public function getAll();
    public function findById(string $id);
    public function findWhere(string $column, string $valor);
    public function findWhereFirst(string $column, string $valor);
}
