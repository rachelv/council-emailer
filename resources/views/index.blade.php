<x-layout>
    <x-slot name="title">All Campaigns</x-slot>

    <h3>All Campaigns</h3>

    <ul>
        @foreach ($campaigns as $campaign)
            <li><a href="{{ $campaign->getUrl() }}">{{ $campaign->getTitle() }}</a></li>
        @endforeach
    </ul>
</x-layout>
