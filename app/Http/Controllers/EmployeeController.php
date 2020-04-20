<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function show($employeeId)
    {
        $employee = Employee::findOrFail($employeeId)->toArray();
        return view('employees.employee', ['employee' => $employee]);
    }

    public function activate($employeeId) {

        $employee = Employee::findOrFail($employeeId);
        $employee->activated = 1;
        $employee->save();

        return view('employees.activate', ['employee' => $employee]);
    }
}
