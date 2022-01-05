<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <title>Laravel Project</title>
    </head>

    <body class="bg-gray-100">
        @include('navigation.menu')
        @yield('content')
    </body>
</html>