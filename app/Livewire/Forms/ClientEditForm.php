<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\User;

class ClientEditForm extends Form
{
    use WithValidation;

    public ?User $user = null;

    public string $name = '';
    public string $email = '';
    public string $address = '';
    public string $residence = '';
    public string $birthdate = '';
    public string $bsn_number = '';
    public string $mobile = '';

    public function setUser(User $user) : void
    {
        $this->user = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->address = $user->address;
        $this->residence = $user->residence;
        $this->birthdate = $user->birthdate;
        $this->bsn_number = $user->bsn_number;
        $this->mobile = $user->mobile;
    }

    public function save() : void
    {
        $this->validate();
        $this->user->update($this->only(['name', 'bsn_number', 'email', 'address', 'residence', 'birthdate', 'mobile']));
        $this->reset();
    }

    public function render()
    {
        return view('livewire.instructor.client-edit-modal');
    }
}

