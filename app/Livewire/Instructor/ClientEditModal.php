<?php

namespace App\Livewire\Instructor;

use Livewire\Component;
use Illuminate\Contracts\View\View;
use App\Models\User;
use LivewireUI\Modal\ModalComponent;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProfileUpdated;


class ClientEditModal extends ModalComponent
{
    public $user;

    public function mount(User $user)
    {
        $this->user = $user->toArray();
    }

    //rules
    protected $rules = [
        'user.name' => 'required|string',
        'user.email' => 'required|email',
        'user.address' => 'required|string',
        'user.residence' => 'required|string',
        'user.birthdate' => 'required|date',
        'user.mobile' => 'required|numeric|digits:10',
    ];

    // updated
    public function update()
    {
        $validatedData = $this->validate();

        $user = User::find($this->user['id']);
        $user->update($validatedData['user']);

        // Here, we use the $user variable that we just defined.
        Mail::to($user->email)->send(new ProfileUpdated($user));

        $this->dispatch('closeModal');
        $this->dispatch('userUpdated');
    }

    public function render(): View
    {
        return view('livewire.instructor.client-edit-modal', [
            'user' => $this->user,
        ]);
    }
}
