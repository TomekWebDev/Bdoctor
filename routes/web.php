<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::middleware('auth')
    ->namespace('Admin')
    ->prefix('admin') //localhost:8080/admin/posts
    ->name('admin.')
    ->group(function () {

        Route::get('/', 'HomeController@index')->name('index');
        Route::resource('/profile', ProfileController::class);
        Route::resource('/messages', MessageController::class);
        Route::resource('/reviews', ReviewController::class);
        Route::resource('/ratings', RatingController::class);
        Route::resource('/sponsors', SponsorController::class);
        Route::resource('/statistics', StatisticController::class);
    });

Route::get('{any?}', function () {
    return view('guest.home');
})->where("any", ".*");
