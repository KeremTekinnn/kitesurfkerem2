<?php

namespace App\Livewire\Instructor;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class ClientList extends Component
{
    use WithPagination;

    #[On('userUpdated')]
    public function updateClientList()
    {
        $this->js('window.location.reload()');
    }


    public function render()
    {
        $instructorId = Auth::user()->id;
        $clientIds = Reservation::where('instructor_id', $instructorId)
                                ->where('status', '!=', 'canceled')
                                ->pluck('client_id')
                                ->toArray();
        $clients = User::whereIn('id', $clientIds)->paginate(10);
        foreach ($clients as $client) {
            $client->reservations = $client->reservationsClient()->where('status', '!=', 'canceled')->get();
        }

        return view('livewire.instructor.client-list',[
            'clients' => $clients,
        ]);
    }
}
