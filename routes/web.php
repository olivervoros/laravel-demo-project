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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');
Route::get('/articles', 'ArticleController@index')->name('articles');
Route::get('/articles/article/{id}', 'ArticleController@view')->name('article');
Route::get('/articles/anotherarticle/{id}', 'ArticleController@anotherview')->name('anotherarticle');
