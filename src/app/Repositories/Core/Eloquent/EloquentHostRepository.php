<?php

namespace App\Repositories\Core\Eloquent;

use App\Models\Host;
use App\Repositories\Contracts\HostRepositoryInterface;

class EloquentHostRepository extends BaseEloquentRepository implements HostRepositoryInterface
{
    public function entity(): string
    {
        return Host::class;
    }

    public function searchByName(string $name)
    {
        // TODO: Implement searchByName() method.
    }
}
