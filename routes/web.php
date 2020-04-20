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

Route::get('employees/{employeeId}','EmployeeController@show')->name('employeePage');

Route::get('employees/{employeeId}/activate', 'EmployeeController@activate')
    ->name('activateAccount')->middleware('signed');
