<?php

namespace App\Repositories\Eloquent;
use App\Models\Post;
use App\Repositories\Contracts\PostRepositoryInterface;

class PostRepository implements PostRepositoryInterface
{
    public function getAllPosts($perPage, $with)
    {
        //perform eager loading to reduce the number of queries and paginate the results to 6 posts per page
        return Post::latest()->with($with)->paginate($perPage);
    }

    public function getPostById($id, $with)
    {
        return Post::with($with)->findOrFail($id);
    }

    public function createPost(array $data)
    {
        return Post::create($data);
    }

    public function updatePost($id, array $data)
    {
        $post = $this->getPostById($id, []);
        $post->update($data);
        return $post;
    }

    public function deletePost($id)
    {
        //implements soft delete 
        
    }

    public function getPostsByUser($userId, $perPage, $with)
    {
        return Post::where('author_id', $userId)->with($with)->latest()->paginate($perPage);
    }
}