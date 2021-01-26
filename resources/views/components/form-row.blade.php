<div class="grid grid-cols-1 md:grid-cols-2 {{ isset($shaded) ? 'bg-gray-100' : 'bg-white'}}">
    <div class="px-6 py-4">
        {{ $form }}
    </div>
    <div class="px-6 py-4 text-sm text-gray-600">
        {{ $tip }}
    </div>
</div>