<?php

namespace App\Observers;

use App\Models\Oscar;

class OscarObserver
{
    /**
     * Handle the Oscar "created" event.
     */
    public function created(Oscar $oscar): void
    {
        //
    }

    public function creating(Oscar $oscar): void
    {
        $date = new \DateTime($oscar->date);
        $year = $date->format("Y");

        $oscar->year = $year;
    }

    /**
     * Handle the Oscar "updated" event.
     */
    public function updated(Oscar $oscar): void
    {
        //
    }

    /**
     * Handle the Oscar "deleted" event.
     */
    public function deleted(Oscar $oscar): void
    {
        //
    }

    /**
     * Handle the Oscar "restored" event.
     */
    public function restored(Oscar $oscar): void
    {
        //
    }

    /**
     * Handle the Oscar "force deleted" event.
     */
    public function forceDeleted(Oscar $oscar): void
    {
        //
    }
}
