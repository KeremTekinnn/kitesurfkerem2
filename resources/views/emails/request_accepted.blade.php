<x-mail::message>
# Request Accepted

Your request has been accepted. Here are the details of your updated reservation:

# Instructor : {{ $reservation->instructor->name }}
@if(!empty($reservation->duo_name))
# Duo Name : {{ $reservation->duo_name }}
@endif
# Location: {{ $reservation->location->meetingplace }}
# Course: {{ $reservation->course->name }}
# Date: {{ $reservation->date }}
# Start Time: {{ $reservation->start_time }}
# End Time: {{ $reservation->end_time }}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
