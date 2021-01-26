<x-layout>
    <x-slot name="title">All Campaigns</x-slot>

    <div class="container p-6">
        <h1>All Campaigns</h1>

        <ul>
            @foreach ($campaigns as $campaign)
                <li><a href="{{ $campaign->getUrl() }}">{{ $campaign->getTitle() }}</a></li>
            @endforeach
        </ul>
    </div>
</x-layout>
