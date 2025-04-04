<?php

namespace App\Livewire\Components;

use Livewire\Component;

class DeclineFriendRequestButton extends Component
{
    public $user;

    public function declineFriendRequest()
    {
        dd('Decline friend request from '.$this->user->name);
    }

    public function mount($user)
    {
        $this->user = $user;
    }

    public function render()
    {
        return view('livewire.components.decline-friend-request-button');
    }
}
