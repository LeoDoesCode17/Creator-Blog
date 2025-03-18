<?php

namespace App\Livewire;

use App\Models\Friendship;
use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;

class SearchPage extends Component
{
    #[Title('Search')]

    public $search = '';

    /**
     * Updates the search results based on the user's input.
     *
     * This method is triggered whenever the `search` property is updated.
     * It performs a search query on the `User` model using the current value
     * of the `search` property and retrieves the matching results. The results
     * are then dispatched as an event named `searchUpdated`.
     *
     * @return void
     */
    public function updatedSearch(){
        $users = User::search($this->search)->get();
        $this->dispatch('searchUpdated', $users);
    }

    public function render()
    {
        return view('livewire.search-page');
    }
}
