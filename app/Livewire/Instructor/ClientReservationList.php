<?php

namespace App\Livewire\Instructor;

use Livewire\Component;
use App\Models\Reservation;
use App\Models\User;
use App\Mail\BadWeatherMail;
use App\Mail\IllnessMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Livewire\WithPagination;

class ClientReservationList extends Component
{
    use WithPagination;

    public $client;
    public $filter = 'all';

    public function mount($clientId)
    {
        $this->client = User::find($clientId);
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

        return redirect()->route('client.reservations', ['clientId' => $reservation->client->id]);
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

        return redirect()->route('client.reservations', ['clientId' => $reservation->client->id]);
    }

    public function render()
    {
        $clientId = $this->client->id;

        switch ($this->filter) {
            case 'today':
                $reservations = Reservation::whereDate('date', Carbon::today())
                ->where('status', '!=', 'canceled')
                ->where('client_id', $clientId)
                ->paginate(10);
            break;
            case 'thisWeek':
                $reservations = Reservation::whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                ->where('status', '!=', 'canceled')
                ->where('client_id', $clientId)
                ->paginate(10);
                break;
            case 'thisMonth':
                $reservations = Reservation::whereMonth('date', Carbon::now()->month)
                ->where('status', '!=', 'canceled')
                ->where('client_id', $clientId)
                ->paginate(10);
            break;
            default:
                $reservations = Reservation::where('status', '!=', 'canceled')
                ->where('client_id', $clientId)
                ->paginate(10);
                break;
        }

        return view('livewire.instructor.client-reservation-list', [
            'reservations' => $reservations,
        ]);
    }
}
