<?php

namespace App\Livewire\Components;

use Livewire\Component;

class AcceptFriendRequestButton extends Component
{
    public $user;

    public function acceptFriendRequest()
    {
        dd('accept friend request from '.$this->user->name);
    }

    public function mount($user)
    {
        $this->user = $user;
    }

    public function render()
    {
        return view('livewire.components.accept-friend-request-button');
    }
}
