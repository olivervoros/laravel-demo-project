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

Route::get('/', 'EmployeeController@index');
Route::get('/employee/{employeeId}', 'EmployeeController@show');
Route::get('/employee/{employeeId}/update', 'EmployeeController@update');
Route::get('/employee/{employeeId}/delete', 'EmployeeController@destroy');
