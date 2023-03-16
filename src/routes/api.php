<?php

use App\Http\Controllers\AwardArtistController;
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

/* Awards Artists */
Route::post("/award/artist", [AwardArtistController::class, "store"]);
Route::get("/award/artist/{id}", [AwardArtistController::class, "findById"]);
Route::put("/award/artist/{id}", [AwardArtistController::class, "update"]);
Route::delete("/award/artist/{id}", [AwardArtistController::class, "delete"]);
