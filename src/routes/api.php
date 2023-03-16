<?php

use App\Http\Controllers\OscarController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/* Routes Oscar Ceremony */
Route::post("/oscar", [OscarController::class, "store"]);
Route::get("/oscar/{year}", [OscarController::class, "findOscarByYear"]);
Route::put("/oscar/{year}", [OscarController::class, "update"]);
Route::delete("/oscar/{year}", [OscarController::class, "delete"]);
