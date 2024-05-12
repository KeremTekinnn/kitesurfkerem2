<div class="p-6 bg-cyan-950">
    <form wire:submit="update">
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input wire:model="user.name" class="mt-1 block w-full" id="name" />
            <x-input-error :messages="$errors->get('user.name')" />
        </div>

        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="user.email" class="mt-1 block w-full" id="email" />
            <x-input-error :messages="$errors->get('user.email')" />
        </div>

        <div class="mt-4">
            <x-input-label for="address" :value="__('Address')" />
            <x-text-input wire:model="user.address" class="mt-1 block w-full" id="address" />
            <x-input-error :messages="$errors->get('user.address')" />
        </div>

        <div class="mt-4">
            <x-input-label for="residence" :value="__('Residence')" />
            <x-text-input wire:model="user.residence" class="mt-1 block w-full" id="residence" />
            <x-input-error :messages="$errors->get('user.residence')" />
        </div>

        <div class="mt-4">
            <x-input-label for="birthdate" :value="__('Birthdate')" />
            <x-date-input wire:model="user.birthdate" class="mt-1 block w-full" id="birthdate" />
            <x-input-error :messages="$errors->get('user.birthdate')" />
        </div>

        @if($user['role'] !== 'client')
        <div class="mt-4">
            <x-input-label for="bsn_number" :value="__('Bsn Number')" />
            <x-text-input wire:model="user.bsn_number" class="mt-1 block w-full" id="bsn_number" />
            <x-input-error :messages="$errors->get('user.bsn_number')" />
        </div>
        @endif

        <div class="mt-4">
            <x-input-label for="mobile" :value="__('Mobile')" />
            <x-text-input wire:model="user.mobile" class="mt-1 block w-full" id="mobile" />
            <x-input-error :messages="$errors->get('user.mobile')" />
        </div>

        <div class="mt-4">
            <x-input-label for="role" :value="__('Role')" />
            <select wire:model="user.role" wire:change="updateRole" class="mt-1 block w-full" id="role">
                @foreach($roles as $role)
                    <option value="{{ $role }}">{{ ucfirst($role) }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('user.role')" />
        </div>

        <div class="mt-4">
            <x-primary-button class="bg-orange">
                {{ __('Save') }}
            </x-primary-button>
        </div>
    </form>
</div>
