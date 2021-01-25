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

    <div class="flex flex-wrap">

        <div class="grid grid-cols-1 md:grid-cols-2">
            {{-- to--}}
            <div class="p-2 bg-gray-100">
                <label>To</label>
                <input type="text" name="to-email" class="mt-1 block w-full" value="{{ config('council-emailer.full-council-email') }}" readonly="readonly"/>
            </div>
            <div class="p-2 bg-gray-100">
                Please note that all emails to {{ config('council-emailer.full-council-email') }} are public record and can be downloaded from Boulder's <a href="{{ config('council-emailer.open-data-catalog-url') }}" target="_blank">Open Data Catalog</a>.
            </div>

            {{-- from--}}
            <div class="p-2 bg-white">
                <label>From</label>
                <input type="text" name="from-name" class="mt-1 block w-full" value="" placeholder="your name"/>
                <input type="text" name="from-email" class="mt-1 block w-full" value="" placeholder="your email address"/>
            </div>
            <div class="p-2 bg-white">
                Including your real name is optional but adds credibility to your email.
            </div>

            {{-- subject --}}
            <div class="p-2 bg-gray-100">
                <label>Subject</label>
                <input type="text" name="subject" class="mt-1 block w-full" value=""/>
            </div>
            <div class="p-2 bg-gray-100">
                Use/modify one of our example subjects or write your own. A unique subject is helpful.
                <ul>
                    @foreach ($campaign->getExampleSubjects() as $subject)
                        <li>{{ $subject }}</li>
                    @endforeach
                </ul>
            </div>

            {{-- email body --}}
            <div class="p-2 bg-white">
                <label>Message</label>
                <textarea name="email-body" class="mt-1 block w-full h-72">
{{ config('council-emailer.email-recipe') }}
                </textarea>
            </div>
            <div class="p-2 bg-white">
                Talking points:
                <ul>
                    @foreach ($campaign->getTalkingPoints() as $talkingPoint)
                        <li>{{ $talkingPoint }}</li>
                    @endforeach
                </ul>
            </div>

            {{-- checkboxes --}}
            <div class="p-2 bg-gray-100">
                <label for="cc-sender" class="block">
                    <input type="checkbox" id="cc-sender" name="cc-sender" value="true" checked>
                    Send me a copy of my email
                </label>

                <label for="cc-local-org" class="block">
                    <input type="checkbox" id="cc-local-org" name="cc-local-org" value="true" checked>
                    Share my email address with {{ $campaign->getOrgName() }}
                </label>
            </div>
            <div class="p-2 bg-gray-100">
                Sharing your email with {{ $campaign->getOrgName() }} ({{ $campaign->getOrgEmail() }}) helps with future organizing efforts related to this campaign.
            </div>

            <div class="p-2 pt-4 bg-white">
                <button type="submit" class="bg-blue-600 hover:bg-blue-900 text-white font-bold py-2 px-5 rounded">Send Email</button>
            </div>
        </div>

    </div>

</x-layout>
