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

// Write queries for all the possible eloquent model relationships
Route::get('/one-to-one', 'AirlineController@oneToOne');

Route::get('/one-to-many', 'AirlineController@oneToMany');

Route::get('/many-to-many', 'AirlineController@manyToMany');

Route::get('/has-one-through', 'AirlineController@hasOneThrough');

Route::get('/has-many-through', 'AirlineController@hasManyThrough');

Route::get('/polymorphic-one-to-one', 'AirlineController@polymorphicOneToOne');

Route::get('/polymorphic-one-to-many', 'AirlineController@polymorphicOneToMany');

Route::get('/polymorphic-many-to-many', 'AirlineController@polymorphicManyToMany');
