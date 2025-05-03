<?php

namespace App\Repositories\Contracts;

interface PostRepositoryInterface
{
    public function getAllPosts($perPage = 6, $with = []);
    public function getPostById($id, $with = []);
    public function createPost(array $data);
    public function updatePost($id, array $data);
    public function deletePost($id);
    public function getFriendPosts($userId, $perPage = 6, $with = []);
}