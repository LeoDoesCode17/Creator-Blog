<?php

namespace App\Repositories\Contracts;

use App\Models\User;

interface FriendshipRepositoryInterface
{
    public function between(User $authedUser, User $visitedUser);
    public function upsertFriendshipRequest(User $authedUser, User $receiverUser);
    public function acceptFriendshipRequest(User $authedUser, User $targetUser);
    public function declineFriendshipRequest(User $authedUser, User $targetUser);
    public function blockFriendshipRequest(User $authedUser, User $targetUser);
}