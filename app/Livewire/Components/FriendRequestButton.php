<?php

namespace App\Livewire\Components;

use App\Exceptions\FriendshipNotFoundException;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Services\FriendshipService;

class FriendRequestButton extends Component
{
    public $user, $label, $color, $action;

    public User $authedUser;

    //this is must use protected/private modifier
    private FriendshipService $friendshipService;

    //solution to constructor injection problem of livewire
    public function boot(FriendshipService $friendshipService)
    {
        //this method is called when the component is instantiated
        $this->friendshipService = $friendshipService;
        $this->authedUser = Auth::user();;
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
        $friendshipRequest = $this->friendshipService->addAsFriend($this->authedUser, $this->user);
        if ($friendshipRequest->wasRecentlyCreated || $friendshipRequest->wasChanged()) {
            $this->dispatch('friendshipRequestCreated')->to('user-profile-page');
        } else {
            session()->flash('message', 'Friend request already sent.');
        }
    }

    private function acceptFriendRequest()
    {
        try{
            $updatedFriendshipRequest = $this->friendshipService->acceptFriendRequest($this->user, $this->authedUser);
            if ($updatedFriendshipRequest->wasChanged()) {
                $this->dispatch('friendshipRequestUpdated')->to('user-profile-page');
            }else{
                session()->flash('alreadyAccepted', "Already friend with {$this->user->name}");
            }
        }catch(FriendshipNotFoundException $e){
            session()->flash('friendshipRequestUpdateError', $e->getMessage());
        }
    }

    private function declineFriendRequest()
    {
        try{
            $updatedFriendshipRequest = $this->friendshipService->declineFriendRequest($this->user, $this->authedUser);
            if ($updatedFriendshipRequest->wasChanged()) {
                $this->dispatch('friendshipRequestUpdated')->to('user-profile-page');
            }else{
                session()->flash('alreadyDeclined', "Friendship request from {$this->user->name} already declined");
            }
        }catch(FriendshipNotFoundException $e){
            session()->flash('friendshipRequestUpdateError', $e->getMessage());
        }
    }

    private function blockFriendRequest()
    {
        try{
            $updatedFriendshipRequest = $this->friendshipService->blockFriendRequest($this->user, $this->authedUser);
            if ($updatedFriendshipRequest->wasChanged()) {
                $this->dispatch('friendshipRequestUpdated')->to('user-profile-page');
            }else{
                session()->flash('alreadyBlocked', "Friendship request from {$this->user->name} already blocked");
            }
        }catch(FriendshipNotFoundException $e){
            session()->flash('friendshipRequestUpdateError', $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.components.friend-request-button');
    }
}
