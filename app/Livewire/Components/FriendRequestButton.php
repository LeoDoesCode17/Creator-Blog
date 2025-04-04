<?php

namespace App\Livewire\Components;

use Livewire\Component;

class FriendRequestButton extends Component
{
    public $user, $label, $color, $action;

    public function mount(
        $user,
        $label,
        $color,
        $action
    )
    {
        $this->user = $user;
        $this->label = $label;
        $this->color = $color;
        $this->action = $action;
    }

    public function callAction()
    {
        //match the action to the method
        match ($this->action){
            'accept' => $this->acceptFriendRequest(),
            'decline' => $this->declineFriendRequest(),
            'block' => $this->blockFriendRequest(),
            default => dd('Invalid action')
        };
    }

    private function acceptFriendRequest()
    {
        dd('Accepted friend request from ' . $this->user->name);
    }

    private function declineFriendRequest()
    {
        dd('Declined friend request from ' . $this->user->name);
    }

    private function blockFriendRequest()
    {
        dd('Blocked friend request from ' . $this->user->name);
    }

    public function render()
    {
        return view('livewire.components.friend-request-button');
    }
}
