<?php


namespace App\Repositories;


use App\Employee;

class EmployeeRepository implements EmployeeRepositoryInterface
{

    public function all() {
        return Employee::orderBy('name')
            ->where('active', 1)
            ->with('company')
            ->get()->map->format();
    }

    public function findById($employeeId)
    {
        return Employee::where('id', $employeeId)->where('active', 1)->with('company')->firstOrFail()->format();
    }

    public function update($employeeId) {

        $employee = Employee::where('id', $employeeId)->firstOrFail();

        $employee->update(request()->only('name'));
    }

    public function delete($employeeId)
    {
        $employee = Employee::where('id', $employeeId)->delete();
    }



}
