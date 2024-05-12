<?php

namespace App\Livewire\Instructor;

use Livewire\Component;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use App\Mail\BadWeatherMail;
use App\Mail\IllnessMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Livewire\WithPagination;

class ClientsReservationList extends Component
{
    use WithPagination;

    public $instructor;
    public $filter = 'all';

    public function mount()
    {
        $this->instructor = Auth::user();
    }

    public function filterChanged($value)
    {
        $this->filter = $value;
    }

    public function sendBadWeatherMail($id)
    {
        $reservation = Reservation::find($id);

        $emails = [$reservation->client->email];
        if ($reservation->duo_email) {
            $emails[] = $reservation->duo_email;
        }

        foreach ($emails as $email) {
            Mail::to($email)->send(new BadWeatherMail($reservation));
        }

        $reservation->update(['status' => 'canceled']);

        session()->flash('success', 'Bad weather mail sent successfully.');

        return redirect()->route('clients.reservations', ['clientId' => $reservation->client->id]);
    }

    public function sendIllnessMail($id)
    {
        $reservation = Reservation::find($id);

        $emails = [$reservation->client->email];
        if ($reservation->duo_email) {
            $emails[] = $reservation->duo_email;
        }

        foreach ($emails as $email) {
            Mail::to($email)->send(new IllnessMail($reservation));
        }

        $reservation->update(['status' => 'canceled']);

        session()->flash('success', 'Illness mail sent successfully.');

        return redirect()->route('clients.reservations', ['clientId' => $reservation->client->id]);
    }

    public function render()
    {
        switch ($this->filter) {
            case 'today':
                $reservations = Reservation::where('instructor_id', $this->instructor->id)
                                           ->where('status', '!=', 'canceled')
                                           ->whereDate('date', Carbon::today())
                                            ->paginate(10);
                break;
            case 'thisWeek':
                $reservations = Reservation::where('instructor_id', $this->instructor->id)
                                           ->where('status', '!=', 'canceled')
                                           ->whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                                            ->paginate(10);
                break;
            case 'thisMonth':
                $reservations = Reservation::where('instructor_id', $this->instructor->id)
                                           ->where('status', '!=', 'canceled')
                                           ->whereMonth('date', Carbon::now()->month)
                                            ->paginate(10);
                break;
            default:
                $reservations = Reservation::where('instructor_id', $this->instructor->id)
                                           ->where('status', '!=', 'canceled')
                                            ->paginate(10);
                break;
        }

        return view('livewire.instructor.clients-reservation-list', [
            'reservations' => $reservations,
        ]);
    }
}
