<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <title>Hello, world!</title>
</head>
<body>
<div class="container">
<h3 class="my-5">Flight Information Board</h3>
<table class="table">
    <thead class="thead-dark">
    <tr>
        <th scope="col">Flight Number</th>
        <th scope="col">Destination</th>
        <th scope="col">Delay</th>
    </tr>
    </thead>
    <tbody id="flightInfoBoard">
    </tbody>
</table>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="{{ asset('/js/app.js') }}"></script>
<script>

    Echo.private('flight-info')
        .listen('FlightDepartedEvent', event => {
            let delay = (event.delayedMinutes) ? "The flight delayed "+event.delayedMinutes+" minutes." : "The flight departed on time.";
            $( "#flightInfoBoard" ).append( "<tr class='flightInfoGreen'><th scope='row'>"+ event.flightNumber +"</th><td>"+ event.destination +"</td><td>"+ delay +"</td></tr>");
        })
        .listen('FlightDepartedLateEvent', event => {
            let delay = (event.delayedMinutes) ? "The flight delayed "+event.delayedMinutes+" minutes." : "The flight departed on time.";
            $( "#flightInfoBoard" ).append( "<tr class='flightInfoOrange'><th scope='row'>"+ event.flightNumber +"</th><td>"+ event.destination +"</td><td>"+ delay +"</td></tr>");
        })
        .listen('FlightCancelledEvent', event => {
            let delay = (event.delayedMinutes) ? "The flight delayed "+event.delayedMinutes+" minutes." : "The flight has been cancelled.";
            $( "#flightInfoBoard" ).append( "<tr class='flightInfoRed'><th scope='row'>"+ event.flightNumber +"</th><td>"+ event.destination +"</td><td>"+ delay +"</td></tr>");
        });
</script>
</body>
</html>
