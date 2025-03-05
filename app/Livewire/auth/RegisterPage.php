<?php

namespace App\Livewire\Auth;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Register')]
class RegisterPage extends Component
{

    public $name;
    public $username;
    public $email;
    public $password;
    public $passwordConfirmation;

    public function render()
    {
        return view('livewire.auth.register-page');
    }
}
