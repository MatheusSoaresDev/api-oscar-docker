<?php

use App\Http\Controllers\ArtistController;
use App\Http\Controllers\AwardArtistController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\OscarController;
use Illuminate\Support\Facades\Route;

/* Routes Oscar Ceremony */
Route::post("/oscar", [OscarController::class, "store"]);
Route::get("/oscar", [OscarController::class, "findAll"]);
Route::get("/oscar/{year}", [OscarController::class, "findOscarByYear"]);
Route::put("/oscar/{year}", [OscarController::class, "update"]);
Route::delete("/oscar/{year}", [OscarController::class, "delete"]);

/* Awards Artists */
Route::post("/award/artist", [AwardArtistController::class, "store"]);
Route::get("/award/artist/{id}", [AwardArtistController::class, "findById"]);
Route::post("/award/artist/oscar/{year}/{awardArtistId}", [AwardArtistController::class, "addAwardToOscar"]);
Route::delete("/award/artist/oscar/{year}/{awardArtistId}", [AwardArtistController::class, "removeAwardFromOscar"]);

/* Artist */
Route::post("/artist", [ArtistController::class, "store"]);
Route::get("/artist/{id}", [ArtistController::class, "findById"]);
Route::put("/artist/{id}", [ArtistController::class, "update"]);

Route::post("/artist/oscar/nominee/{year}", [ArtistController::class, "addNomineeArtistToOscar"]);
Route::delete("/artist/oscar/nominee/{year}", [ArtistController::class, "removeNomineeArtistFromOscar"]);

Route::patch("/artist/oscar/winner/{year}", [ArtistController::class, "nomineeWinnerOrNoWinner"]);

/* Movie */
Route::post("/movie", [MovieController::class, "store"]);
Route::get("/movie/{id}", [MovieController::class, "findById"]);
Route::put("/movie/{id}", [MovieController::class, "update"]);
