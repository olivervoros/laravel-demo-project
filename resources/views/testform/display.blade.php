@extends('layout')
@section('content')
    <div class="container my-4">
        <h2>Welcome to our Website!</h2>
        <p>Please register below:</p>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ action('FormController@store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="exampleInputFullName">Full Name</label>
                <input class="form-control" name="fullname" id="fullname" aria-describedby="fullnameHelp"
                       placeholder="Enter your full name">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp"
                       placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We will never share your email with anyone
                    else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
            </div>
            <button id="submitForm" type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
