<?php

namespace App\Repositories\Contracts;
interface HostRepositoryInterface
{
    public function searchByName(string $name);
}
