<?php

namespace App\Http\Controllers;

use App\Providers\RegisteredUserWonEvent;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    public function create() {

        return view('register.create');
    }

    public function store(Request $request) {

        $request->validate([
            'name' => 'required|max:255|string',
            'email' => 'required|email',
            'password' => 'required|max:255|string|confirmed',
            'age' => 'required|numeric|min:18|max:120'
        ]);

        $newUser = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'age' => $request->input('age')
        ]);

        // Draw
        if($this->hasUserWon()) {

            // The registered user wins, send a notification email and send a text message too
            event(new RegisteredUserWonEvent($newUser));

        } else {

            dd('No win today!');
        }

        //return redirect('/');
    }

    private function hasUserWon() {
        $randomNumber = rand(1, 100);
        return ($randomNumber % 2 === 0);
    }
}
