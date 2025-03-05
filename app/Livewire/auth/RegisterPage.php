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
    public $password_cnfirmation;


    public function register(){
        // $data = [
        //     'name' => $this->name,
        //     'username' => $this->username,
        //     'email' => $this->email,
        //     'password' => $this->password,
        //     'password_confirmation' => $this->passwordConfirmation,
        // ];
        // dd($data);
        $this->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
    }

    public function render()
    {
        return view('livewire.auth.register-page');
    }
}
