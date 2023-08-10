<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <!-- Fonts -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('assets/front/css/bootstrap.min.css') }}" rel="stylesheet">

</head>

<body>
    <div id="app">
        <div class="container ">
            <div class="col-md-12 text-center">
                <p>Sorry, You have no permission to access this page.</p>
                @if(!Auth::check())
                    <a href="{{ route('home') }}">Home</a>
                @elseif(Auth::user()->role == 'admin')
                    <a href="{{ route('admin-dashboard') }}">Go To Admin Dashboard</a>
                @else
                    <a href="{{ route('home') }}">Go To User Dashboard</a>
                @endif
                
            </div>
        </div>
    </div>

</body>

</html>