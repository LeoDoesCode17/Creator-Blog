<?php

namespace App\Livewire;

use Livewire\Component;

class PostCard extends Component
{
    public $post;

    public function render()
    {
        return view('livewire.post-card');
    }
}
