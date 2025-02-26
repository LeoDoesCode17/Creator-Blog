<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

class ProfilePage extends Component
{
    #[Title('Profile')]
    public function render()
    {
        return view('livewire.profile-page');
    }
}
