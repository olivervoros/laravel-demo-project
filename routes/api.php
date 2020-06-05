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

Route::post('/register', 'API\AuthController@register');
Route::post('/login', [ 'as' => 'login', 'uses' => 'API\AuthController@login']);

Route::middleware(['auth:api'])->group(function () {
    Route::get('/logout', 'API\AuthController@logout');
    Route::get('/getloggedinpassenger', 'API\AuthController@getLoggedInPassenger');

    Route::get('flightreviews', 'FlightreviewController@index');
    Route::get('flightreviews/{id}', 'FlightreviewController@show');
    Route::post('flightreviews', 'FlightreviewController@store');
    Route::put('flightreviews/{id}', 'FlightreviewController@update');
    Route::delete('flightreviews/{id}', 'FlightreviewController@delete');
});
