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

    <a class="text-sm mb-3 block" href="{{ route('index') }}">&larr; All Campaigns</a>

    <h1>{{ $campaign->getTitle() }}</h1>

    <p>talking points are:</p>
    <ul>
        @foreach ($campaign->getTalkingPoints() as $talkingPoint)
            <li>{{ $talkingPoint }}</li>
        @endforeach
    </ul>

    <form>
        <p>To:</p>
        <p><input type="text" name="to-email" value="{{ config('council-emailer.full-council-email') }}" readonly/></p>
        <p>Please note that all emails to {{ config('council-emailer.full-council-email') }} are public record and can be downloaded from Boulder's <a href="{{ config('council-emailer.open-data-catalog-url') }}" target="_blank">Open Data Catalog</a>.</p>

        <p>From:</p>
        <p><input type="text" name="from-email" value="" placeholder="your email address"/></p>

        <p>Subject:</p>
        <p><input type="text" name="subject" value=""/></p>
        <p>Use/tweak one of our example subjects or write your own:</p>
        <ul>
            @foreach ($campaign->getExampleSubjects() as $subject)
                <li>{{ $subject }}</li>
            @endforeach
        </ul>

        <p>Email:</p>
        <textarea name="email-body">
{{ config('council-emailer.email-recipe') }}
        </textarea>

        <p>
            <input type="checkbox" id="cc-sender" name="cc-sender" value="true" checked>
            <label for="cc-sender">Send me a copy of my email</label>
        </p>

        <p>
            <input type="checkbox" id="cc-local-org" name="cc-local-org" value="true" checked>
            <label for="cc-local-org">Share my email address with {{ $campaign->getOrgName() }} ({{ $campaign->getOrgEmail() }}) to help them with future organizing efforts</label>
        </p>

        <p>
            <button type="submit">Send Email</button>
        </p>

    </form>
</x-layout>
