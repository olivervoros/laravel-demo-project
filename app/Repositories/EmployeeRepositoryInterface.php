<?php

namespace App\Repositories;

interface EmployeeRepositoryInterface
{
    public function all();

    public function findById($employeeId);

    public function update($employeeId);

    public function delete($employeeId);
}
