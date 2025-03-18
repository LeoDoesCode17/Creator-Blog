<?php

namespace App\Livewire;

use App\Models\Friendship;
use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;

class SearchPage extends Component
{
    #[Title('Search')]

    public $users;

    public function mount(){
        $this->users = User::all();
    }
    
    public function render()
    {
        return view('livewire.search-page');
    }
}
