<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\Attributes\Title;

#[Title('Profile')]
class UserProfilePage extends Component
{
    public $user;

    public function mount($username){
        $this->user = User::where('username', $username)->firstOrFail();
    }
    public function render()
    {
        return view('livewire.user-profile-page');
    }
}
