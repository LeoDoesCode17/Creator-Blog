<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class UsersList extends Component
{

    public $users = [];

    public function mount(){
        $this->users = User::all()->toArray();
    }

    /**
     * The event listeners for the Livewire component.
     *
     * @var array
     * 
     * This property listens for the 'searchUpdated' event and triggers the 
     * 'updateUsers' method when the event is fired.
     */
    protected $listeners = ['searchUpdated' => 'updateUsers',];

    public function updateUsers($users){
        $this->users = $users;
    }

    public function render()
    {
        return view('livewire.users-list');
    }
}
