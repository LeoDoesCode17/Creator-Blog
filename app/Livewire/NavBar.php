<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\User;

class NavBar extends Component
{
 
    public User $user;
    public $friendshipRequests;

    public function mount(){
        $this->user = Auth::user();

        if (! $this->user instanceof User) {
            abort(403, 'Unauthorized');
        }

        $this->friendshipRequests = $this->user->getFriendshipRequests();
    }

    public function render()
    {
        return view('livewire.nav-bar');
    }
}
