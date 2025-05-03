<?php

namespace App\Repositories\Contracts;

interface PostRepositoryInterface
{
    public function getAllPosts($perPage, $with);
    public function getPostById($id, $with);
    public function createPost(array $data);
    public function updatePost($id, array $data);
    public function deletePost($id);
    public function getPostsByUser($userId, $perPage, $with);
}