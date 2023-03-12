<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOscarRequest;
use App\Models\Oscar;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OscarController extends Controller
{
    private $oscar;
    public function __construct()
    {
        $this->oscar = app(Oscar::class);
    }

    public function create(CreateOscarRequest $request): JsonResponse
    {
        $data = $request->only(["year", "edition", "local", "date", "city", "hosteds", "curiosities"]);
        return $this->oscar->create($data);
    }
}
