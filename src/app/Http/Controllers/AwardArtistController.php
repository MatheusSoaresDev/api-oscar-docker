<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AwardArtistController extends Controller
{
    private $exception;

    public function __construct(OscarExceptions $exception)
    {
        $this->exception = $exception;
    }
}
