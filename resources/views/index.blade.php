@extends('layout')
@section('content')
    <div class="container my-4">
        <h1>Hello World!</h1>
        <p><a href="{{ url('/formtest') }}">Go to the registration form</a></p>
        <p><a href="{{ url('/dashboard') }}">Go to dashboard</a></p>
    </div>
