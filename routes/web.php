<?php

use App\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

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

Route::get('/test', function () {

    User::where('email', 'testthomas@test.com')->delete();

    $newUser = User::create(array(

        'name' => "tEST thoMaS",
        'email' => 'TESTthomas@test.com',
        'personal_id' => random_int(1000000, 9999999),
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),

    ));

    dd("NAME: ".$newUser->name." EMAIL: ".$newUser->email." PERSONAL_ID: ".$newUser->personal_id);

});
