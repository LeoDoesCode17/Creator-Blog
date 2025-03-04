<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Register')]

class Register extends Component
{
    public function render()
    {
        return view('livewire.register');
    }
}
