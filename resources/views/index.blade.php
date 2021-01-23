<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>All Campaigns | Council Emailer</title>
    </head>
    <body>
        <h3>All Campaigns</h3>

        <ul>
            @foreach ($campaigns as $campaign)
                <li><a href="{{ $campaign->getUrl() }}">{{ $campaign->getTitle() }}</a></li>
            @endforeach
        </ul>
    </body>
</html>
