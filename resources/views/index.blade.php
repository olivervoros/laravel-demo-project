@extends('layout')
@section('content')
    <div class="container my-4">
        <h1>Hello World!</h1>
        <p><a href="{{ url('/formtest') }}">Go to the registration form</a></p>
        <p><a href="{{ url('/dashboard') }}">Go to dashboard</a></p>
        <button id="openPrompt" class="btn btn-info" onclick="myFunction()">Click to open the prompt!</button>
        <p id="demo"></p>
    </div>
@section('js')
    <script>
        function myFunction() {
            let txt;
            let person = prompt("Please enter your name:", "Stranger");
            if (person == null || person == "") {
                txt = "User cancelled the prompt.";
            } else {
                txt = "Hello " + person + "! How are you today?";
            }
            document.getElementById("demo").innerHTML = txt;
        }
    </script>
