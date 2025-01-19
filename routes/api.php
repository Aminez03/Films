<?php

use App\Http\Controllers\CategorieController;
use App\Http\Controllers\FilmController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Route protégée
Route::group(['middleware' => ['auth:api']],function () {
    Route::resource('categories', CategorieController::class);
});

// Route protégée
Route::group(['middleware' => ['auth:api']],function () {
    Route::resource('films', FilmController::class);
});







Route::get('/getfilmlistcat/{idcat}', [FilmController::class, 'showFilmsByCAT']);

Route::get('/films/film/filmspaginate', [FilmController::class, 'filmsPaginate']);




use App\Http\Controllers\AuthController;

Route::group(['middleware' => 'api', 'prefix' => 'users'], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refreshToken', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
});
Route::get('users/verify-email', [AuthController::class, 'verifyEmail'])->name('verify.email');
