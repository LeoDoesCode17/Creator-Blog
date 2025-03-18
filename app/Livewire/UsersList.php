<?php

namespace App\Livewire;

use Livewire\Component;

class UsersList extends Component
{

    public $users;

    public $search;

    public function render()
    {
        return view('livewire.users-list');
    }
}
