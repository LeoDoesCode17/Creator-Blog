<?php

namespace App\Repositories\Contracts;
use App\Models\Post;

class PostRepository implements PostRepositoryInterface
{
    public function getAllPosts($perPage = 6, $with = [])
    {
        //perform eager loading to reduce the number of queries and paginate the results to 6 posts per page
        return Post::latest()->with($with)->paginate($perPage);
    }

    public function getPostById($id, $with = [])
    {
        return Post::with($with)->findOrFail($id);
    }

    public function createPost(array $data)
    {
        return Post::create($data);
    }

    public function updatePost($id, array $data)
    {
        $post = $this->getPostById($id);
        $post->update($data);
        return $post;
    }

    public function deletePost($id)
    {
        //implements soft delete 
        
    }

    public function getFriendPosts($userId, $perPage = 6, $with = [])
    {
        
    }
}