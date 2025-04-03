<?php

namespace App\Livewire;

use Livewire\Component;

class NavBar extends Component
{
 
    public $user, $friendshipRequests;

    public function mount(){
        $this->user = auth()->user();
        $this->friendshipRequests = auth()->user()->getFriendshipRequests();
    }

    public function render()
    {
        return view('livewire.nav-bar');
    }
}
