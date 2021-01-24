<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $campaign->getTitle() }} | Council Emailer</title>
    </head>
    <body>
        <h3></h3>

        
    </body>
</html>

<x-layout>
    <x-slot name="title">{{ $campaign->getTitle() }}</x-slot>

    <h3>{{ $campaign->getTitle() }}</h3>
    
    <p>org is {{ $campaign->getOrgName() }}</p>
    <p>email is {{ $campaign->getOrgEmail() }}</p>
    <p>talking points are:</p>
    <ul>
        @foreach ($campaign->getTalkingPoints() as $talkingPoint)
            <li>{{ $talkingPoint }}</li>
        @endforeach
    </ul>
</x-layout>
