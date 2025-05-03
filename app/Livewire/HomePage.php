<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Attributes\Title;
use Livewire\Component;

class HomePage extends Component
{
    #[Title('Home')]
    public function render()
    {
        $posts = Post::all();
        return view('livewire.home-page', ['posts' => $posts]);
    }
}
