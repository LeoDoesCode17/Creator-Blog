<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Title;
use Livewire\Component;

use function PHPUnit\Framework\throwException;

#[Title('Login')]
class LoginPage extends Component
{
    //identifier means email or username
    public $identifier;
    public $password;

    protected $rules = [
        'identifier' => 'required',
        'password' => 'required',
    ];

    public function login(){

        //determine if the identifier is an email or username
        $fieldType = filter_var($this->identifier, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $this->validate();

        //atempt to login
        if(Auth::attempt([
            $fieldType => $this->identifier,
            'password' => $this->password,
        ])){
            return redirect()->route('home');
        }

        throw ValidationException::withMessages([
            'auth' => 'Invalid credentials'
        ]);

    }

    public function render()
    {
        return view('livewire.auth.login-page');
    }
}
