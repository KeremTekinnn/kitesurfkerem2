<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Request;
use App\Mail\RequestAccepted;
use App\Mail\RequestCanceled;
use Illuminate\Support\Facades\Mail;
use Livewire\WithPagination;

class RequestList extends Component
{
    use WithPagination;

    public function render()
    {
        $requests = Request::paginate(10);
        return view('livewire.admin.request-list', [
            'requests' => $requests,
        ]);
    }

    public function acceptRequest($requestId)
    {
        // Find the request
        $request = Request::find($requestId);

        if ($request) {
            // Find the associated reservation
            $reservation = $request->reservation;

            if ($reservation) {
                // Update the date, start_time, and end_time of the reservation
                $reservation->date = $request->new_date;
                $reservation->start_time = $request->new_start_time;
                $reservation->end_time = $request->new_end_time;
                $reservation->save();
            }

            $emails = [$request->reservation->client->email];
            if ($reservation->duo_email) {
                $emails[] = $reservation->duo_email;
            }

            foreach ($emails as $email) {
                Mail::to($email)->send(new RequestAccepted($reservation));
            }

            // Delete the request
            $request->delete();
        }
    }

    public function cancelRequest($requestId)
    {
        // Find the request
        $request = Request::find($requestId);

        if ($request) {
            Mail::to($request->reservation->client->email)->send(new RequestCanceled());
            $request->delete();
        }
    }
}
