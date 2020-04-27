<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CollectionController;

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

Route::get('/filter', 'CollectionController@filter');
Route::get('/search', 'CollectionController@search');
Route::get('/chunk', 'CollectionController@chunk');
Route::get('/map', 'CollectionController@map');
Route::get('/zip', 'CollectionController@zip');
Route::get('/wherenotin', 'CollectionController@wherenotin');
Route::get('/max', 'CollectionController@max');
Route::get('/pluck', 'CollectionController@pluck');
Route::get('/each', 'CollectionController@each');
Route::get('/tap', 'CollectionController@tap');
Route::get('/pipe', 'CollectionController@pipe');
Route::get('/contains', 'CollectionController@contains');
Route::get('/forget', 'CollectionController@forget');
Route::get('/avg', 'CollectionController@avg');
Route::get('/collapse', 'CollectionController@collapse');
Route::get('/combine', 'CollectionController@combine');
Route::get('/nth', 'CollectionController@nth');
Route::get('/times', 'CollectionController@times');
Route::get('/take', 'CollectionController@take');
Route::get('/last', 'CollectionController@last');
Route::get('/reverse', 'CollectionController@reverse');
Route::get('/only', 'CollectionController@only');



