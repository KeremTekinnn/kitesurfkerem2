<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Reservation;
use App\Mail\BadWeatherMail;
use App\Mail\IllnessMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class UsersReservationList extends Component
{
    use WithPagination;

    public $filter = 'all';

    public function filterChanged($value)
    {
        $this->filter = $value;
    }

    public function sendBadWeatherMail($id)
    {
        $reservation = Reservation::find($id);

        $emails = [$reservation->client->email, $reservation->instructor->email];

        foreach ($emails as $email) {
            Mail::to($email)->send(new BadWeatherMail($reservation));
        }

        $reservation->update(['status' => 'canceled']);

        session()->flash('success', 'Bad weather mail sent successfully.');

        return redirect()->route('users.reservations');
    }

    public function sendIllnessMail($id)
    {
        $reservation = Reservation::find($id);

        $emails = [$reservation->client->email, $reservation->instructor->email];

        foreach ($emails as $email) {
            Mail::to($email)->send(new IllnessMail($reservation));
        }

        $reservation->update(['status' => 'canceled']);

        session()->flash('success', 'Illness mail sent successfully.');

        return redirect()->route('users.reservations');
    }

    public function render()
    {
        switch ($this->filter) {
            case 'today':
                $reservations = Reservation::where('status', '!=', 'canceled')
                                           ->whereDate('date', Carbon::today())
                                           ->paginate(10);
                break;
            case 'thisWeek':
                $reservations = Reservation::where('status', '!=', 'canceled')
                                           ->whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                                           ->paginate(10);
                break;
            case 'thisMonth':
                $reservations = Reservation::where('status', '!=', 'canceled')
                                           ->whereMonth('date', Carbon::now()->month)
                                           ->paginate(10);
                break;
            default:
                $reservations = Reservation::where('status', '!=', 'canceled')
                                           ->paginate(10);
                break;
        }

        return view('livewire.admin.users-reservation-list', [
            'reservations' => $reservations,
        ]);
    }
}
