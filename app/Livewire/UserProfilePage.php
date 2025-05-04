<?php

namespace App\Livewire;

use App\Models\Friendship;
use Livewire\Component;
use App\Models\User;
use App\Repositories\Contracts\FriendshipRepositoryInterface;
use App\Services\FriendshipService;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

#[Title('Profile')]
class UserProfilePage extends Component
{
    use WithPagination;

    public $user;
    private FriendshipService $frienshipService;

    protected $listeners = [
        'friendshipRequestCreated' => 'updateFriendshipReceiverStatus',
        'friendshipRequestUpdated' => 'updateFriendshipReceiverStatus',
    ];

    public function boot(FriendshipService $friendshipService)
    {
        $this->frienshipService = $friendshipService;
    }

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
        $authedUser = Auth::user();

        //get the friendship request relationship(sender and receiver) between the authed user and visited user
        // $friendshipRequest = Friendship::between($authedUser, $this->user);

        //using friendship repository
        $friendshipRequest = $this->frienshipService->getFriendshipRequests($authedUser, $this->user);

        return view('livewire.user-profile-page', [
            'friendship' => $friendshipRequest->friendship,
            'isSender' => $friendshipRequest->isSender,
        ]);
    }
}
