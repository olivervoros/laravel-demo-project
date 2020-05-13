<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller
{

    public function index()
    {
        return view('testForm.display');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'fullname' => 'required|max:255',
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        dd($request->toArray());
    }
}
