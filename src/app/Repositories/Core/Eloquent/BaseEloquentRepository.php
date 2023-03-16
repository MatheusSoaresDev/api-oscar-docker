<?php

namespace App\Repositories\Core\Eloquent;

use App\Exceptions\NotEntityDefined;
use App\Repositories\Contracts\RepositoryInterface;

class BaseEloquentRepository implements RepositoryInterface
{
    protected $entity;

    public function __construct()
    {
        $this->entity = $this->resolveEntity();
    }

    public function store(array $data)
    {
        return $this->entity->create($data);
    }

    public function update(string $id, array $data)
    {
        $entity = $this->findById($id);
        $entity->update($data);
        return $entity;
    }

    public function delete(string $id)
    {
        return $this->entity->find($id)->delete();
    }

    public function findById(string $id)
    {
        return $this->entity->find($id);
    }

    public function resolveEntity()
    {
        return !method_exists($this, 'entity') ? throw new NotEntityDefined : app($this->entity());
    }
}
