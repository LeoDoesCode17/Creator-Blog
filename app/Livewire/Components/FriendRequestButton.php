<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Friendship;
use Illuminate\Support\Facades\Auth;

class FriendRequestButton extends Component
{
    public $user, $label, $color, $action;

    public function mount(
        $user,
        $label,
        $color,
        $action
    ) {
        $this->user = $user;
        $this->label = $label;
        $this->color = $color;
        $this->action = $action;
    }

    public function callAction()
    {
        //match the action to the method
        match ($this->action) {
            'add' => $this->addFriendRequest(),
            'accept' => $this->acceptFriendRequest(),
            'decline' => $this->declineFriendRequest(),
            'block' => $this->blockFriendRequest(),
            default => dd('Invalid action')
        };
    }

    // private function addFriendRequest()
    // {
    //     // dd(auth()->user()->id, $this->receiverId, FriendshipStatus::PENDING->value);
    //     //create friend request
    //     $authedUser = auth()->user();

    //     //determine if the friendship request already exists
    //     $friendshipRequest = $authedUser->getFriendshipReceiverStatus($this->user->id);

    //     if ($friendshipRequest) {
    //         $friendshipStatus = $friendshipRequest->status;
    //         switch ($friendshipStatus) {
    //             case FriendshipStatus::DECLINED->value:
    //                 //get the friendship request and update the status to PENDING
    //                 //this is the update code
    //                 $friendshipRequest->update([
    //                     'status' => FriendshipStatus::PENDING->value,
    //                     'updated_at' => now(),
    //                 ]);
    //                 $this->dispatch('friendRequestCreated')->to('user-profile-page');;
    //                 return;
    //             default:
    //                 return;
    //         }
    //     }
    //     $friendship = Friendship::create([
    //         'sender_id' => $authedUser->id,
    //         'receiver_id' => $this->user->id,
    //         'status' => FriendshipStatus::PENDING->value,
    //         'created_at' => now(),
    //         'updated_at' => now(),
    //     ]);

    //     if ($friendship) {
    //         $this->dispatch('friendRequestCreated')->to('user-profile-page');
    //     } else {
    //         dd('Failed to create request');
    //     }
    // }

    private function addFriendRequest()
    {
        $authedUser = Auth::user();
        $friendshipRequest = Friendship::createOrUpdateFriendshipRequest($authedUser, $this->user);
        if ($friendshipRequest->wasRecentlyCreated || $friendshipRequest->wasChanged()) {
            $this->dispatch('friendRequestCreated')->to('user-profile-page');
        } else {
            session()->flash('message', 'Friend request already sent.');
        }
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
