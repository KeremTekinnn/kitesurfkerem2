<div class="p-6 bg-cyan-950">
    @error('error')
        <div role="alert" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
            <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
                Error
            </div>
            <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
                <p>{{ $message }}</p>
            </div>
        </div>
    @enderror
    <form wire:submit="submit">
        <div class="mt-4">
            <x-input-label for="date" :value="__('Select New Date')" />
            <x-date-input wire:model.live='date' class="mt-1 block w-full" id="date" />
            @error('date')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mt-4">
            <x-input-label for="time" :value="__('Select New Time')" />
            <select wire:model='selectedTimeSlot' class="mt-1 block w-full" id="time">
                @foreach ($timeSlots as $index => $timeSlot)
                    <option value="{{ $index }}" {{ $index == 0 ? 'selected' : '' }}>
                        {{ $timeSlot['start_time'] }} - {{ $timeSlot['end_time'] }}</option>
                @endforeach
            </select>
            @error('selectedTimeSlot')
                <div class="alert alert-danger" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
                    {{ $message }}</div>
            @enderror
        </div>

        <div class="mt-4">
            <x-input-label for="reason" :value="__('Reason')" />
            <x-text-input wire:model='reason' class="mt-1 block w-full" id="reason" />
            @error('reason')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mt-4">
            <x-primary-button class="bg-orange">
                {{ __('Submit') }}
            </x-primary-button>
        </div>
    </form>
</div>
