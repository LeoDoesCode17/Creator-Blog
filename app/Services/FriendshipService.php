<?php

namespace App\Services;
use App\Repositories\Contracts\{PostRepositoryInterface, FriendshipRepositoryInterface};
use App\Models\User;

class FriendshipService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        private PostRepositoryInterface $postRepository,
        private FriendshipRepositoryInterface $friendshipRespository
    )
    {}

    public function getFriendshipRequests(User $user1, User $user2)
    {
        //this function to get friendship request betweem two users
        return $this->friendshipRespository->getFriendshipBetween($user1, $user2);
    }
}
