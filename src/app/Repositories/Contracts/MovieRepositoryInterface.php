<?php

namespace App\Repositories\Contracts;

interface MovieRepositoryInterface
{
    public function addNomineeMovieToOscar(string $yearOscar, array $data):void;
    public function removeNomineeMovieFromOscar(string $yearOscar, array $data):void;
    public function nomineeWinnerOrNoWinner(string $yearOscar, array $data):void;
}
