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
        $request->validate([
            'fullname' => 'required|max:255',
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        return redirect('/dashboard');
    }

    public function dashboard()
    {
        return view('dashboard.index');
    }
}
