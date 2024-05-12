<?php

namespace App\Livewire\Client;

use Livewire\Component;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Livewire\Attributes\On;
use Carbon\Carbon;
use Livewire\WithPagination;

class ReservationList extends Component
{
    use WithPagination;

    public $filter;

    public function filterChanged($value)
    {
        $this->filter = $value;
    }

    #[On('requestSended')]
    public function updateReservationList()
    {
        session()->flash('success', 'Request has been sent successfully');
    }

    public function render()
    {
        switch ($this->filter) {
            case 'today':
                $reservations = Reservation::where('client_id', Auth::id())
                    ->whereDate('date', Carbon::today())
                    ->paginate(10);
                break;
            case 'thisWeek':
                $reservations = Reservation::where('client_id', Auth::id())
                    ->whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                    ->paginate(10);
                break;
            case 'thisMonth':
                $reservations = Reservation::where('client_id', Auth::id())
                    ->whereMonth('date', Carbon::now()->month)
                    ->paginate(10);
                break;
            default:
                $reservations = Reservation::where('client_id', Auth::id())->paginate(10);
        }

        return view('livewire.client.reservation-list', [
            'reservations' => $reservations,
        ]);
    }
}
