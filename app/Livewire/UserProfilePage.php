<?php

namespace App\Livewire;

use App\Models\Friendship;
use Livewire\Component;
use App\Models\User;
use App\Repositories\Contracts\FriendshipRepositoryInterface;
use Illuminate\Support\Facades\Auth;
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

    public function render(FriendshipRepositoryInterface $friendshipRepository)
    {
        $authedUser = Auth::user();

        //get the friendship request relationship(sender and receiver) between the authed user and visited user
        // $friendshipRequest = Friendship::between($authedUser, $this->user);

        //using friendship repository
        $friendshipRequest = $friendshipRepository->between($authedUser, $this->user);

        return view('livewire.user-profile-page', [
            'friendship' => $friendshipRequest->data,
            'isSender' => $friendshipRequest->isSender,
        ]);
    }
}
