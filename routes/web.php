<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/weatherforecast/{city?}', 'WeatherForecastController@index');

// Implicit Route - Model Binding
Route::get('weatherlogs', function (App\WeatherLog $log) {

    return view('weatherlogs', array('logs' => $log::all()));
});
