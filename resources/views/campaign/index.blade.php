<x-layout>
    <x-slot name="title">{{ $campaign->getTitle() }}</x-slot>

    <div class="container p-6">
        <a class="text-sm mb-3 block" href="{{ route('index') }}">&larr; All Campaigns</a>
        <h1>{{ $campaign->getTitle() }}</h1>
    </div>

    <form data-component="form-validator">
        {{-- to--}}
        <x-form-row>
            <x-slot name="shaded">true</x-slot>
            <x-slot name="form">
                <label>To</label>
                <input type="text" name="to-email" class="mt-1 block w-full" value="{{ \App\Config::getGlobalConfig('full-council-email') }}" readonly/>
            </x-slot>
            <x-slot name="tip">
                Please note that all emails to {{ \App\Config::getGlobalConfig('full-council-email') }} are public record and can be downloaded from Boulder's <a href="{{ \App\Config::getGlobalConfig('open-data-catalog-url') }}" target="_blank">Open Data Catalog</a>.
            </x-slot>
        </x-form-row>

        {{-- from--}}
        <x-form-row>
            <x-slot name="form">
                <label>From</label>
                <input type="text" name="from-name" class="mt-1 block w-full" value="" placeholder="your name"/>
                <input data-element="email-el" type="text" name="from-email" class="mt-1 block w-full" value="" placeholder="your email address"/>
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
                <input data-element="subject-el" type="text" name="subject" class="mt-1 block w-full" value="{{ $campaign->getRandomSubject() }}"/>
            </x-slot>
            <x-slot name="tip">
                Use or modify one of our example subjects, or write your own. A unique subject makes your email much more likely to be read.
            </x-slot>
        </x-form-row>

        {{-- email body --}}
        <x-form-row>
            <x-slot name="form">
                <label>Message</label>
                <textarea name="email-body" class="mt-1 block w-full h-72">
{{ \App\Config::getGlobalConfig('email-recipe') }}
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

                <label for="bcc-local-org" class="block">
                    <input type="checkbox" id="cc-local-org" name="cc-local-org" value="true" checked>
                    Share my email address with {{ $campaign->getOrgName() }}
                </label>
            </x-slot>
            <x-slot name="tip">
                Sharing your email with {{ $campaign->getOrgName() }} ({{ $campaign->getOrgEmail() }}) helps with future organizing efforts related to this campaign.
            </x-slot>
        </x-form-row>

        <div class="p-6">
            <button data-element="button-el" type="submit" class="bg-blue-600 text-white font-bold py-2 px-5 rounded" disabled>Send Email</button>
        </div>
    </form>

    <script src="{{ mix('/js/form-validator.js') }}"></script>

</x-layout>
