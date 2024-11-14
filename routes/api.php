<?php

use App\Http\Controllers\CategorieController;
use App\Http\Controllers\FilmController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::middleware('api')->group(function () {
    Route::resource('categories', CategorieController::class);});


    Route::middleware('api')->group(function () {
    Route::resource('films', FilmController::class);});

    Route::get('/listfilms/{idcat}', [FilmController::class,'showFilmsByCAT']);

    Route::get('/films/film/filmspaginate', [FilmController::class,'filmsPaginate']);