<?php

namespace App\Http\Controllers;

use App\Repositories\EmployeeRepositoryInterface;

class EmployeeController extends Controller
{

    private $employeeRepository;

    /**
     * EmployeeController constructor.
     * @param $employeeRepository
     */
    public function __construct(EmployeeRepositoryInterface $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }


    public function index()
    {

        return $this->employeeRepository->all();

    }

    public function show($employeeId)
    {

        return $this->employeeRepository->findById($employeeId);
    }

    public function update($employeeId)
    {

        $this->employeeRepository->update($employeeId);

        return redirect("/employee/$employeeId");
    }

    public function destroy($employeeId)
    {

        $this->employeeRepository->delete($employeeId);

        return redirect("/");
    }
}
