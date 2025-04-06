<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Contracts\FriendshipRepositoryInterface;

class FriendshipRepository implements FriendshipRepositoryInterface
{
    public function between(User $authedUser, User $visitedUser)
    {
        $authedAsSender = $authedUser->getFriendshipReceiverStatus($visitedUser->id);
        $authedAsReceiver = $visitedUser->getFriendshipReceiverStatus($authedUser->id);

        //data means the frienship request model
        return (object)[
            // if authedAsSender not null then store it in data else store authedAsReceiver in data
            'data' => $authedAsSender ?? $authedAsReceiver,
            // if authedAsSender not null then authed user is sender if authedAsReceiver not null authed user is receiver else null
            'isSender' => $authedAsSender ? true : ($authedAsReceiver ? false : null),
        ];
    }   
}