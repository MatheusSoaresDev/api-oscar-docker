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

    /**
     * @throws OscarQueryEditionException
     */
    public function updating(Oscar $oscar): void
    {
        $date = new \DateTime($oscar->date);
        $year = $date->format("Y");

        $oscar->year = $year;
        $this->verifyExistsEditionWithNameUpdated($oscar);
    }

    /**
     * @throws OscarQueryEditionException
     */
    private function verifyExistsEditionWithNameUpdated(Oscar $oscar): void
    {
        $otherOscar = Oscar::where("edition", $oscar->edition)->where("id", "!=", $oscar->id)->first();

        if ($otherOscar) {
            throw new OscarQueryEditionException("Ceremony already exists with edition name: $oscar->edition", 500);
        }
    }
}
