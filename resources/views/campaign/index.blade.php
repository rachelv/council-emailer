<x-layout>
    <x-slot name="title">{{ $campaign->getTitle() }}</x-slot>

    <div class="container p-6">
        <a class="text-sm mb-3 block" href="{{ route('index') }}">&larr; All Campaigns</a>
        <h1>{{ $campaign->getTitle() }}</h1>
    </div>


    {{-- to--}}
    <x-form-row>
        <x-slot name="shaded">true</x-slot>
        <x-slot name="form">
            <label>To</label>
            <input type="text" name="to-email" class="mt-1 block w-full" value="{{ config('council-emailer.full-council-email') }}" readonly="readonly"/>
        </x-slot>
        <x-slot name="tip">
            Please note that all emails to {{ config('council-emailer.full-council-email') }} are public record and can be downloaded from Boulder's <a href="{{ config('council-emailer.open-data-catalog-url') }}" target="_blank">Open Data Catalog</a>.
        </x-slot>
    </x-form-row>

    {{-- from--}}
    <x-form-row>
        <x-slot name="form">
            <label>From</label>
            <input type="text" name="from-name" class="mt-1 block w-full" value="" placeholder="your name"/>
            <input type="text" name="from-email" class="mt-1 block w-full" value="" placeholder="your email address"/>
        </x-slot>
        <x-slot name="tip">
            Including your real name is optional but adds credibility to your email. Your email address is required.
        </x-slot>
    </x-form-row>

    {{-- subject --}}
    <x-form-row>
        <x-slot name="shaded">true</x-slot>
        <x-slot name="form">
            <label>Subject</label>
            <input type="text" name="subject" class="mt-1 block w-full" value=""/>
        </x-slot>
        <x-slot name="tip">
            Use/modify one of our example subjects or write your own. A unique subject is helpful.
            <ul>
                @foreach ($campaign->getExampleSubjects() as $subject)
                    <li>{{ $subject }}</li>
                @endforeach
            </ul>
        </x-slot>
    </x-form-row>

    {{-- email body --}}
    <x-form-row>
        <x-slot name="form">
            <label>Message</label>
            <textarea name="email-body" class="mt-1 block w-full h-72">
{{ config('council-emailer.email-recipe') }}
            </textarea>
        </x-slot>
        <x-slot name="tip">
            Talking points:
            <ol class="list-decimal">
                @foreach ($campaign->getTalkingPoints() as $talkingPoint)
                    <li class="ml-4">{{ $talkingPoint }}</li>
                @endforeach
            </ol>
        </x-slot>
    </x-form-row>

    {{-- checkboxes --}}
    <x-form-row>
        <x-slot name="shaded">true</x-slot>
        <x-slot name="form">
            <label for="cc-sender" class="block">
                <input type="checkbox" id="cc-sender" name="cc-sender" value="true" checked>
                Send me a copy of my email
            </label>

            <label for="cc-local-org" class="block">
                <input type="checkbox" id="cc-local-org" name="cc-local-org" value="true" checked>
                Share my email address with {{ $campaign->getOrgName() }}
            </label>
        </x-slot>
        <x-slot name="tip">
            Sharing your email with {{ $campaign->getOrgName() }} ({{ $campaign->getOrgEmail() }}) helps with future organizing efforts related to this campaign.
        </x-slot>
    </x-form-row>

    <div class="p-6">
        <button type="submit" class="bg-blue-600 hover:bg-blue-900 text-white font-bold py-2 px-5 rounded">Send Email</button>
    </div>
</x-layout>
