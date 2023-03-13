<?php

namespace App\Observers;

use App\Exceptions\OscarQueryDateException;
use App\Exceptions\OscarQueryEditionException;
use App\Models\Oscar;

class OscarObserver
{
    public function creating(Oscar $oscar): void
    {
        $date = new \DateTime($oscar->date);
        $year = $date->format("Y");

        $oscar->year = $year;
    }

    public function updating(Oscar $oscar): void
    {
        $date = new \DateTime($oscar->date);
        $year = $date->format("Y");

        $oscar->year = $year;
        $this->verifyExistsEditionWithNameUpdated($oscar);
        $this->verifyExistsCeremonyYear($oscar);
    }

    private function verifyExistsEditionWithNameUpdated(Oscar $oscar): void
    {
        $otherOscar = Oscar::where("edition", $oscar->edition)->where("id", "!=", $oscar->id)->first();

        if($otherOscar){
            throw new OscarQueryEditionException("Oscar ceremony already exists with edition name: $oscar->edition", 500);
        }
    }

    /**
     * @throws OscarQueryDateException
     */
    private function verifyExistsCeremonyYear(Oscar $oscar): void
    {
        $otherOscar = Oscar::whereYear("date", $oscar->year)->where("id", "<>", $oscar->id)->first();

        if($otherOscar){
            throw new OscarQueryDateException("Oscar ceremony already exists with date a year: $oscar->year.", 500);
        }
    }
}
