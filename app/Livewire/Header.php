<?php

namespace App\Livewire;

use Livewire\Component;

class Header extends Component
{

    public $title;

    public function render()
    {
        return view('livewire.header');
    }
}
