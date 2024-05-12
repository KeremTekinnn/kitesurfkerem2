<x-mail::message>
# Request Canceled

Your request could not be accepted due to invalid reason. You can call us if you have any questions.

<x-mail::button :url="route('reservations')">
Check Reservations
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
