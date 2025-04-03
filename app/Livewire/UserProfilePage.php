<?php

namespace App\Livewire;

use App\Models\Friendship;
use Livewire\Component;
use App\Models\User;
use Livewire\Attributes\Title;

#[Title('Profile')]
class UserProfilePage extends Component
{
    public $user, $friendship;

    public function mount($username){
        $this->user = User::where('username', $username)->firstOrFail();
        $this->friendship = Friendship::getRelationship(auth()->user()->id, $this->user->id);
    }
    public function render()
    {
        return view('livewire.user-profile-page');
    }
}
