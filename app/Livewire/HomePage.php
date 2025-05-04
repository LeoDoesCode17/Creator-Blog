<?php

namespace App\Livewire;

use App\Repositories\Contracts\PostRepositoryInterface;
use App\Services\PostService;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;

class HomePage extends Component
{
    #[Title('Home')]
    private PostService $postService;

    public function boot(PostService $postService) {
        $this->postService = $postService;
    }
    public function render()
    {
        $posts = $this->postService->getFriendsPosts(Auth::user(), 6, ['author', 'category']);
        return view('livewire.home-page', ['posts' => $posts]);
    }
}
