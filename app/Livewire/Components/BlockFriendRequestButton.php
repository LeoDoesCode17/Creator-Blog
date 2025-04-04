<?php

namespace App\Livewire\Components;

use Livewire\Component;

class BlockFriendRequestButton extends Component
{
    public $user;

    public function blockFriendRequest()
    {
        dd('block friend request from '.$this->user->name);
    }

    public function mount($user)
    {
        $this->user = $user;
    }

    public function render()
    {
        return view('livewire.components.block-friend-request-button');
    }
}
