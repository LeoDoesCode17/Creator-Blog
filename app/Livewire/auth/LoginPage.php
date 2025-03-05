<?php

namespace App\Livewire\Auth;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Login')]
class LoginPage extends Component
{
    //identifier means email or username
    public $identifier;
    public $password;

    public function login(){
        $data = [
            'identifier' => $this->identifier,
            'password' => $this->password,
        ];
        dd($data);
    }

    public function render()
    {
        return view('livewire.auth.login-page');
    }
}
