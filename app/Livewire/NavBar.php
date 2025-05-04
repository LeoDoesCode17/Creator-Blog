<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\User;
use App\Repositories\Contracts\FriendshipRepositoryInterface;

class NavBar extends Component
{
 
    public User $user;
    public $friendshipRequests;
    private $friendshipRepository;

    public function boot(FriendshipRepositoryInterface $friendshipRepository){
        $this->friendshipRepository = $friendshipRepository;
    }

    public function mount(){
        $this->user = Auth::user();

        if (! $this->user instanceof User) {
            abort(403, 'Unauthorized');
        }

        $this->friendshipRequests = $this->friendshipRepository->getPendingFriendshipRequest($this->user);
    }

    public function render()
    {
        return view('livewire.nav-bar');
    }
}
