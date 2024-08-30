<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Sidebar Menu')</title>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: "Roboto", "Helvetica", "Arial", sans-serif;
        }
        .row > *{
            padding-right: 0px !important;
            padding-left: 0px !important;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row p-0" style="padding:0px !important">
            <!-- Sidebar -->
            @include('layouts.sidebar')

            <!-- Main Content -->
            <div class="col-10 bg-light">
                @include('layouts.navbar')
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
