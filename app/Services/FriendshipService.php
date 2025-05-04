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

    public function addAsFriend(User $user1, User $user2)
    {
        //this function add new friend where the sender is $user1 and the receiver is $user2
        return $this->friendshipRespository->upsertFriendshipRequest($user1, $user2);
    }

    public function acceptFriendRequest(User $user1, User $user2)
    {
        //this function accept the friend request where the sender is $user1 and the receiver is $user2
        return $this->friendshipRespository->acceptFriendshipRequest($user2, $user1);
    }

    public function declineFriendRequest(User $user1, User $user2)
    {
        //this function decline the friend request where the sender is $user1 and the receiver is $user2
        return $this->friendshipRespository->declineFriendshipRequest($user2, $user1);
    }

    public function blockFriendRequest(User $user1, User $user2)
    {
        //this function block the friend request where the sender is $user1 and the receiver is $user2
        return $this->friendshipRespository->blockFriendshipRequest($user2, $user1);
    }
}
