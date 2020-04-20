<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{

    public function index() {

        return view('employees.index', ['employees' => Employee::all()]);
    }
}
