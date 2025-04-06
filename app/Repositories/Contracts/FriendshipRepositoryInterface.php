<?php

namespace App\Repositories\Contracts;

use App\Models\User;

interface FriendshipRepositoryInterface
{
    public function between(User $authedUser, User $visitedUser);
}