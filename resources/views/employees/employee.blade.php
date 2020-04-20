@php
$url = URL::temporarySignedRoute('activateAccount', now()->addMinutes(30), ['employeeId' => $employee['id']])
@endphp
<h2>Hello {{ $employee['name'] ?? "Stranger" }}!</h2>
<a href="{{ $url }}">Click on this link to activate your account!</a>
