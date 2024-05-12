<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class UserList extends Component
{
    use WithPagination;

    public $filter = 'all';

    // Listen for the event 'userUpdated'
    #[On('userUpdated')]
    public function updateUserList()
    {
        $this->js('window.location.reload()');
    }

    // Filter the users based on the role
    public function filterChanged($value)
    {
        $this->filter = $value;
    }

    // Render the filtered users
    public function render()
    {
        switch ($this->filter) {
            case 'client':
                $users = User::where('role', 'client')->paginate(10);
                break;
            case 'instructor':
                $users = User::where('role', 'instructor')->paginate(10);
                break;
            case 'admin':
                $users = User::where('role', 'admin')->paginate(10);
                break;
            default:
                $users = User::paginate(10);
                break;
        }

        return view('livewire.admin.user-list', [
            'users' => $users,
        ]);
    }
}
