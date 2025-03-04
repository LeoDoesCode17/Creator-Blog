<?php

namespace App\Livewire;

use Livewire\Component;

class NavLink extends Component
{

    public $name;
    public $routeName;
    public $smallScreen;

    public function render()
    {
        return view('livewire.nav-link');
    }
}
