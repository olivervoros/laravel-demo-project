<h2>List of Employees</h2>
@foreach($employees as $employee)
    <p>ID: @prependCompanyName($employee->id, $employee->company) NAME: {{ $employee->name }}</p>
@endforeach
