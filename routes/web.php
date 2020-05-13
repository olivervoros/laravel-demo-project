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
    return view('index');
});

Route::get('/formtest', 'FormController@index')->name('displayForm');;
Route::post('/formtest', 'FormController@store');
Route::get('/dashboard', 'FormController@dashboard')->name('dashboard');;
