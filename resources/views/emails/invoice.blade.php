<x-mail::message>
# Invoice

Thank you for your payment. Your payment was successful. Here are the details of your reservation:

# Instructor : {{ $reservation->instructor->name }}
@if(!empty($reservation->duo_name))
# Duo Name : {{ $reservation->duo_name }}
@endif
# Location: {{ $reservation->location->meetingplace }}
# Course: {{ $reservation->course->name }}
# Date: {{ $reservation->date }}
# Start Time: {{ $reservation->start_time }}
# End Time: {{ $reservation->end_time }}
# Amount: ${{ $invoice->amount }}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
