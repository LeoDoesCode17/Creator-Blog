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
        $posts = Post::latest()->with(['author', 'category'])->paginate(6); //perform eager loading to reduce the number of queries and paginate the results to 6 posts per page
        return view('livewire.home-page', ['posts' => $posts]);
    }
}
