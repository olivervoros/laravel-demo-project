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

Route::get('/weatherforecast/{city?}', 'WeatherForecastController@index');

// Implicit Route - Model Binding
Route::get('weatherlogs', function (App\WeatherLog $log) {

    return view('weatherlogs', array('logs' => $log::all()));
});

// Get weatherlog by ID implicitly
Route::get('weatherlogs/{weatherLog}', function (App\WeatherLog $weatherLog) {

    return $weatherLog;
});

// Explicit binding in the route service provider boot() method...
Route::get('from-route-service-provider/{log}', function (App\WeatherLog $log) {

    return $log;
});

// Explicit binding in the route service provider boot() method using own resolution logic...
Route::get('from-route-service-provider-by-slug/{slug}', function (App\WeatherLog $log) {

    return $log;
});

