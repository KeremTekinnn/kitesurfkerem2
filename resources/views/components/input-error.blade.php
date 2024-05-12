@props(['messages'])

@if ($messages)
    <ul x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" {{ $attributes->merge(['class' => 'text-sm text-red-600 space-y-1']) }}>
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
