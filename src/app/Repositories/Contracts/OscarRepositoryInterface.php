<?php

namespace App\Repositories\Contracts;

interface OscarRepositoryInterface
{
    public function findAll();
    public function findOscarByYear(int $year);
}
