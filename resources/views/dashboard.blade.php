<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>World Population</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

</head>
<body class="antialiased">
    <div class="container">
        <h3>1. World population: {{$worldPopulation}}</h3>

        <h3>2. Top 20 countries population: </h3>
        <ul>
            @foreach($topTwentyCountryPopulation as $value)
                <ol>{{$value}}</ol>
            @endforeach
        </ul>

        <h3>3. List country's population</h3>
        <table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Ranking</th>
                <th>Population</th>
            </tr>
            </thead>
            <tbody>
            @foreach($countriesPopulation->items() as $country)
            <tr>
                <td>{{$country}}</td>
                <td></td>
                <td></td>
            </tr>
            @endforeach
            </tbody>
        </table>
        {{ $countriesPopulation->links() }}
    </div>
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>
