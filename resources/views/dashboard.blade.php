@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Secret Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                            <p>Hello {{ Auth::user()->name }}, welcome on the admin page!</p>
                            <p>You are logged in and you should be an admin user if you see this page!</p>
                            <p>Your role is: {{ Auth::user()->role->role }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
