<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class NavBar extends Component
{

    public function logout(){
        //Remove the user from laravel's auth system
        Auth::logout();

        //Destroy the current session because the old session id can still be used (session fixation attack risk)
        Session::invalidate();

        //Generate a new CSRF token because the old token can still be used (CSRF attack risk)
        Session::regenerateToken();

        //Redirect to loginn page
        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.nav-bar');
    }
}
