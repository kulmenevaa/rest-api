<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->group(function() {
    Route::apiResources([
        'news'      => NewsController::class,
        'events'    => EventController::class,
        'themes'    => EventThemeController::class
    ]);
});

Route::controller(UserController::class)->group(function() {
    Route::post('register', 'register')->name('register'); // sign_up
    Route::post('login', 'login')->name('login'); // sign_in
    Route::post('logout', 'logout')->name('logout')->middleware(['auth:api']); // sign_out
});
