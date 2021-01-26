<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <title>{{ $title }} | Council Emailer</title>
    </head>
    <body class="text-gray-800 font-sans">
        {{ $slot }}
    </body>
</html>