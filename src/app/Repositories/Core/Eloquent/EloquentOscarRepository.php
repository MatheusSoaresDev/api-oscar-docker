<?php

namespace App\Repositories\Core\Eloquent;

use App\Models\Oscar;
use App\Repositories\Contracts\OscarRepositoryInterface;
use App\Transforms\TransformCreateManyCuriosities;
use App\Transforms\TransformCreateManyHostsOscar;

class EloquentOscarRepository extends BaseEloquentRepository implements OscarRepositoryInterface
{
    public function entity(): string
    {
        return Oscar::class;
    }

    public function store(array $data)
    {
        $oscar = parent::store($data);
        $oscar->hosts()->createMany(TransformCreateManyHostsOscar::handle($data));
        $oscar->curiosities()->createMany(TransformCreateManyCuriosities::handle($data));
        return $oscar;
    }

    public function findOscarByYear(int $year)
    {
        return $this->entity->whereYear("date", $year)->with(["hosts", "curiosities"])->firstOrFail();
    }
}
