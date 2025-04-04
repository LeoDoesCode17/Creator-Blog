<?php

namespace App\Livewire\Components;

use App\Enums\FriendshipStatus;
use Livewire\Component;
use App\Models\Friendship;

class AddFriendButton extends Component
{
    public $receiverId;

    public function mount($receiverId)
    {
        $this->receiverId = $receiverId;
    }

    public function addFriend()
    {   
        // dd(auth()->user()->id, $this->receiverId, FriendshipStatus::PENDING->value);
        //create friend request
        $authedUser = auth()->user();

        //determine if the friendship request already exists
        $friendshipRequest = $authedUser->getFriendshipReceiverStatus($this->receiverId);

        if($friendshipRequest){
            $friendshipStatus = $friendshipRequest->status;
            switch ($friendshipStatus){            
                case FriendshipStatus::DECLINED->value:
                    //get the friendship request and update the status to PENDING
                    //this is the update code
                    $friendshipRequest->update([
                        'status' => FriendshipStatus::PENDING->value,
                        'updated_at' => now(),
                    ]);
                    $this->dispatch('friendRequestCreated')->to('user-profile-page');;
                    return;
                default:
                    return;
            }
        }
        $friendship = Friendship::create([
            'sender_id' => $authedUser->id,
            'receiver_id' => $this->receiverId,
            'status' => FriendshipStatus::PENDING->value,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if($friendship){
            $this->dispatch('friendRequestCreated')->to('user-profile-page');
        }else{
            dd('Failed to create request');
        }
    }

    public function render()
    {
        return view('livewire.components.add-friend-button');
    }
}
