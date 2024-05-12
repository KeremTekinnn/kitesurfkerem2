<x-mail::message>
# Profile Updated

Your profile has been updated. Here are the details of your updated profile:

# Name : {{ $user->name }}
# Email : {{ $user->email }}
# Address: {{ $user->address}}
# Residence: {{ $user->residence}}
# Birthdate: {{ $user->birthdate }}
# Mobile: {{ $user->mobile }}
@if($user->role === 'admin' || $user->role === 'instructor')
# BSN Number: {{ $user->bsn_number }}
# Role: {{ $user->role }} @endif

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
