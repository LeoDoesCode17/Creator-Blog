<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Friendship;
use App\Repositories\Contracts\FriendshipRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class FriendRequestButton extends Component
{
    public $user, $label, $color, $action;

    //this is must use protected/private modifier
    private FriendshipRepositoryInterface $friendshipRepository;

    //solution to constructor injection problem of livewire
    public function boot(FriendshipRepositoryInterface $friendshipRepository)
    {
        //this method is called when the component is instantiated
        $this->friendshipRepository = $friendshipRepository;
    }
    //make the constructor to inject the friendship repository 
    // this way doesn't work because livewire instantiate component using new Static(), so livewire doesn't know that there is a parameter that must be injected ($friendshipRepository)
    // public function __construct($id=null, FriendshipRepositoryInterface $friendshipRepository)
    // {
    //     parent::__construct($id);
    //     $this->friendshipRepository = $friendshipRepository;
    // }
    //solution of make the $friendshipRepository as a public property : using boot method

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

    private function addFriendRequest()
    {
        $authedUser = Auth::user();
        // $friendshipRequest = Friendship::createOrUpdateFriendshipRequest($authedUser, $this->user);
        $friendshipRequest = $this->friendshipRepository->upsertFriendshipRequest($authedUser, $this->user);
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
