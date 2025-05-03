<?php

namespace App\Livewire;

use App\Repositories\Contracts\PostRepositoryInterface;
use Livewire\Attributes\Title;
use Livewire\Component;

class HomePage extends Component
{
    #[Title('Home')]
    private $postRepository;
    public function boot(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }
    public function render()
    {
        $posts = $this->postRepository->getAllPosts(6, ['author', 'category']);
        return view('livewire.home-page', ['posts' => $posts]);
    }
}
