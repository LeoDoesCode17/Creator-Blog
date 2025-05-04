<?php

namespace App\Repositories\Contracts;

use App\Models\Friendship;
use App\Models\User;

interface FriendshipRepositoryInterface
{
    public function getFriendshipBetween(User $authedUser, User $visitedUser);
    public function upsertFriendshipRequest(User $authedUser, User $receiverUser);
    public function acceptFriendshipRequest(User $authedUser, User $targetUser);
    public function declineFriendshipRequest(User $authedUser, User $targetUser);
    public function blockFriendshipRequest(User $authedUser, User $targetUser);
    public function getFriendship(User $user1, User $user2);
    public function getPendingFriendshipRequest(User $user);
    public function getAcceptedFriendshipRequest(User $user);
}