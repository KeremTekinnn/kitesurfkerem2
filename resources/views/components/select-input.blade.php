@props(['id', 'disabled' => false])

<div>
    <select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm']) !!}>
        {{ $slot }}
    </select>
    @error($attributes->whereStartsWith('wire:model')->first())
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
