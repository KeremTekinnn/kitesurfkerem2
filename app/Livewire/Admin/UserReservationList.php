<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Reservation;
use App\Mail\BadWeatherMail;
use App\Mail\IllnessMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class UserReservationList extends Component
{

    use WithPagination;

    public $user;
    public $filter = 'all';

    public function mount($userId)
    {
        $this->user = User::find($userId);
    }

    #[On('reservationUpdated')]
    public function updateReservationList()
    {
        $this->js('window.location.reload()');
    }

    public function filterChanged($value)
    {
        $this->filter = $value;
    }

    public function sendBadWeatherMail($id)
    {
        $reservation = Reservation::find($id);
        Mail::to($reservation->client->email)->send(new BadWeatherMail($reservation));

        $reservation->update(['status' => 'canceled']);

        if ($this->user->isInstructor()) {
            return redirect()->route('user.reservations', ['userId' => $reservation->instructor->id]);
        }

        return redirect()->route('user.reservations', ['userId' => $reservation->client->id]);
    }

    public function sendIllnessMail($id)
    {
        $reservation = Reservation::find($id);
        Mail::to($reservation->client->email)->send(new IllnessMail($reservation));

        $reservation->update(['status' => 'canceled']);

        if ($this->user->isInstructor()) {
            return redirect()->route('user.reservations', ['userId' => $reservation->instructor->id]);
        }

        return redirect()->route('user.reservations', ['userId' => $reservation->client->id]);
    }

    public function render()
    {
        $userId = $this->user->id;

        switch ($this->filter) {
            case 'today':
                $reservations = Reservation::whereDate('date', Carbon::today())
                ->where('status', '!=', 'canceled')
                ->where(function ($query) use ($userId) {
                    $query->where('instructor_id', $userId)
                          ->orWhere('client_id', $userId);
                })->paginate(10);
            break;
            case 'thisWeek':
                $reservations = Reservation::whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                ->where('status', '!=', 'canceled')
                ->where(function ($query) use ($userId) {
                    $query->where('instructor_id', $userId)
                          ->orWhere('client_id', $userId);
                })->paginate(10);
                break;
            case 'thisMonth':
                $reservations = Reservation::whereMonth('date', Carbon::now()->month)
                ->where('status', '!=', 'canceled')
                ->where(function ($query) use ($userId) {
                    $query->where('instructor_id', $userId)
                          ->orWhere('client_id', $userId);
                })->paginate(10);
            break;
            default:
                $reservations = Reservation::where('status', '!=', 'canceled')
                ->where(function ($query) use ($userId) {
                    $query->where('instructor_id', $userId)
                        ->orWhere('client_id', $userId);
                })->paginate(10);
                break;
        }

        return view('livewire.admin.user-reservation-list', [
            'reservations' => $reservations,
        ]);
    }
}
