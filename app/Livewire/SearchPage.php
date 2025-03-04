<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

class SearchPage extends Component
{
    #[Title('Search')]
    public function render()
    {
        return view('livewire.search-page');
    }
}
