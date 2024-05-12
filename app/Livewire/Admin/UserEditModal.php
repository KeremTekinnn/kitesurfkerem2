<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Contracts\View\View;
use App\Models\User;
use LivewireUI\Modal\ModalComponent;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProfileUpdated;

class UserEditModal extends ModalComponent
{
    public $user;
    public $roles;
    public function mount(User $user)
    {
        $this->user = $user->toArray();
        $this->roles = ['client', 'instructor', 'admin'];
    }

    // Define rules method
    public function rules()
    {
        $rules = [
            'user.name' => 'required|string',
            'user.email' => 'required|email',
            'user.address' => 'required|string',
            'user.residence' => 'required|string',
            'user.birthdate' => 'required|date',
            'user.mobile' => 'required|numeric|digits:10',
            'user.role' => 'required|in:client,instructor,admin',
        ];

        if ($this->user && $this->user['role'] !== 'client') {
            $rules['user.bsn_number'] = 'required|numeric|digits:9';
        }

        return $rules;
    }

    // updated
    public function update()
    {
        $validatedData = $this->validate();

        $user = User::find($this->user['id']);

        // Check if the role is changing from instructor to client
        $roleChanged = $user->role !== $validatedData['user']['role'];

        // Update the user data
        $user->update($validatedData['user']);

        // If role is changing from instructor to client, clear BSN number
        if ($roleChanged && $validatedData['user']['role'] === 'client') {
            $user->update(['bsn_number' => null]);
        }

        Mail::to($user->email)->send(new ProfileUpdated($user));

        $this->dispatch('closeModal');
        $this->dispatch('userUpdated');
    }

    public function updateRole()
    {
        if ($this->user['role'] === 'client') {
            $this->user['bsn_number'] = null;
        }
    }

    public function render(): View
    {
        return view('livewire.admin.user-edit-modal', [
            'user' => $this->user,
            'roles' => $this->roles,
        ]);
    }
}
