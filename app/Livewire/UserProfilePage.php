<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

#[Title('Profile')]
class UserProfilePage extends Component
{
    use WithPagination;

    public $user;

    protected $listeners = [
        'friendRequestCreated' => 'updateFriendshipReceiverStatus'
    ];

    public function mount($username)
    {
        $this->user = User::where('username', $username)->firstOrFail();
    }

    public function updateFriendshipReceiverStatus()
    {
        $this->resetPage();
    }

    public function render()
    {
        $authedUser = auth()->user();

        //check if the authed user is the sender of the friendship request
        $friendshipAsSender =  $authedUser->getFriendshipReceiverStatus($this->user->id);

        //check if the authed user is the receiver of the friendship request
        $friendshipAsReceiver = $this->user->getFriendshipReceiverStatus($authedUser->id);

        if ($friendshipAsSender){
            $relationship = $friendshipAsSender;
            $isSender = true;
        }else if ($friendshipAsReceiver){
            $relationship = $friendshipAsReceiver;
            $isSender = false;
        }else{
            $relationship = null;
            $isSender = null;
        }
        return view('livewire.user-profile-page', [
            'friendship' => $relationship,
            'isSender' => $isSender,
        ]);
    }
}
