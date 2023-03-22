<?php

namespace App\Repositories\Contracts;

interface OscarRepositoryInterface
{
    public function findOscarByYear(int $year);
}
