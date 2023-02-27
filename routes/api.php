<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('Api')
    ->prefix('/profiles')
    ->group(function () {
        //Homepage methods
        Route::get('/specs', 'ProfileControllerGuest@getSpecs');
        Route::get('/sponsored', 'ProfileControllerGuest@getAllSponsored');
        // Search page methods
        Route::get('/{id}', 'ProfileControllerGuest@show');
        //post method
        Route::post('/', 'ProfileControllerGuest@searchProfilesBySpec');
        Route::post('/sponsored', 'ProfileControllerGuest@getSponsoredWithSpecs');
    });

Route::namespace('Api')
    ->prefix('/message')
    ->group(function () {
        Route::post("/", 'MessageControllerGuest@store'); // forma diversa con la classe e parametro tra apici che indica la funzione del controller

    });

Route::namespace('Api')
    ->prefix('/review')
    ->group(function () {
        Route::post("/", 'ReviewControllerGuest@store'); // forma diversa con la classe e parametro tra apici che indica la funzione del controller

    });

Route::namespace('Api')
    ->prefix('/rating')
    ->group(function () {
        Route::get("/", 'RatingControllerGuest@index'); // forma diversa con la classe e parametro tra apici che indica la funzione del controller
        Route::post("/", 'RatingControllerGuest@store');
    });
