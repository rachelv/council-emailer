<x-layout>
    <x-slot name="title">{{ $campaign->getTitle() }}</x-slot>

    @if(request()->session()->has('success') || request()->session()->has('error'))
        <div class="container text-white">
            @if(request()->session()->has('success'))
                <div class="px-6 py-3 bg-green-500">
                    {{ request()->session()->get('success') }}
                </div>
            @endif
            @if(request()->session()->has('error'))
                <div class="px-6 py-3 bg-red-500">
                    {{ request()->session()->get('error') }}
                </div>
            @endif
        </div>
    @endif

    <div class="container p-6">
        <a class="text-sm mb-3 block" href="{{ route('index') }}">&larr; All Campaigns</a>
        <h1>{{ $campaign->getTitle() }}</h1>
    </div>

    <div id="v-council-form" :initializeSubjects="initializeSubjects({{ $campaign->getExampleSubjectsJson() }})">
        <form method="POST" action="{{ route('campaignSendEmail', ['slug' => $campaign->getSlug()]) }}">
            {{-- to--}}
            <x-form-row>
                <x-slot name="shaded">true</x-slot>
                <x-slot name="form">
                    <label>To</label>
                    <input type="text" name="to-email" class="mt-1 text-input" value="{{ implode(', ', $toEmails) }}" readonly/>
                    @if($isTestMode)
                        <div class="mt-1 text-green-600 text-sm">You're in test mode. Emails will not go to city council.</div>
                    @endif
                </x-slot>
                <x-slot name="tip">
                    Please note that all emails to {{ \App\Config::getGlobalConfig('full-council-email') }} are public record and can be downloaded from Boulder's <a href="{{ \App\Config::getGlobalConfig('open-data-catalog-url') }}" target="_blank">Open Data Catalog</a>.
                </x-slot>
            </x-form-row>

            {{-- from--}}
            <x-form-row>
                <x-slot name="form">
                    <label>From</label>
                    <input v-model="fromName" type="text" name="from-name" class="mt-1 text-input" value="" placeholder="your name (required)"/>
                    <input v-model="fromEmail" v-on:keyup="isEmailValid" type="text" name="from-email" class="mt-1 text-input" placeholder="your email address (required)"/>
                    <div v-if="showEmailError" class="mt-1 error-message">Please enter a valid email address.</div>
                </x-slot>
                <x-slot name="tip">
                    Including your real name adds credibility to your email.
                </x-slot>
            </x-form-row>

            {{-- subject --}}
            <x-form-row>
                <x-slot name="shaded">true</x-slot>
                <x-slot name="form">
                    <label>Subject</label>
                    <input v-model="subject" type="text" name="subject" class="mt-1 text-input"/>
                    <div class="mt-1 ml-1 text-sm"><a v-on:click.prevent="updateSubject" href="#">Use a different subject</a></div>
                </x-slot>
                <x-slot name="tip">
                    Use or modify one of our example subjects, or write your own. A unique subject makes your email much more likely to be read.
                </x-slot>
            </x-form-row>

            {{-- email body --}}
            <x-form-row>
                <x-slot name="form">
                    <label>Message</label>
                    <textarea name="email-body" class="mt-1 h-72 text-input" placeholder="{{ \App\Config::getGlobalConfig('email-recipe') }}"></textarea>
                </x-slot>
                <x-slot name="tip">
                    @if($campaign->hasReferences())
                        <div class="mt-2">
                            References:
                            <ol class="list-decimal">
                                @foreach ($campaign->getReferences() as $reference)
                                    <li class="ml-4"><a href="{{ $reference[1] }}" target="_blank">{{ $reference[0] }}</a></li>
                                @endforeach
                            </ol>
                        </div>
                    @endif
                    @if($campaign->hasTalkingPoints())
                        <div class="mt-2">
                            Talking points:
                            <ol class="list-decimal">
                                @foreach ($campaign->getTalkingPoints() as $talkingPoint)
                                    <li class="ml-4">{{ $talkingPoint }}</li>
                                @endforeach
                            </ol>
                        </div>
                    @endif
                    @if($campaign->hasAsks())
                        <div class="mt-2">
                            Requests:
                            <ol class="list-decimal">
                                @foreach ($campaign->getAsks() as $ask)
                                    <li class="ml-4">{{ $ask }}</li>
                                @endforeach
                            </ol>
                        </div>
                    @endif
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
                        <input type="checkbox" id="bcc-local-org" name="bcc-local-org" value="true" checked>
                        Share my email address with {{ $campaign->getOrgName() }}
                    </label>
                </x-slot>
                <x-slot name="tip">
                    Sharing your email with {{ $campaign->getOrgName() }} ({{ $campaign->getOrgEmail() }}) helps with future organizing efforts related to this campaign.
                    @if($isTestMode)
                        <div class="mt-1 text-green-600 text-sm">You're in test mode. Local org will not be bcc'ed no matter what.</div>
                    @endif
                </x-slot>
            </x-form-row>

            <div class="p-6">
                @csrf
                <button type="submit" class="submit-button" :disabled="!submitIsEnabled">Send Email</button>
            </div>
        </form>
    </div>

    <script src="{{ mix('/js/council-form.js') }}"></script>

</x-layout>
