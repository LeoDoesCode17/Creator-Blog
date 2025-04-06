<?php

namespace App\Repositories\Eloquent;

use App\Models\Friendship;
use App\Models\User;
use App\Repositories\Contracts\FriendshipRepositoryInterface;
use App\Enums\FriendshipStatus;

class FriendshipRepository implements FriendshipRepositoryInterface
{
    //function to get information about friendship request between authed user and visitedUser and information about whether the authed user is the sender or receiver of the friendship request
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

    public function upsertFriendshipRequest(User $authedUser, User $receiverUser)
    {
        $friendshipRequest = $authedUser->getFriendshipReceiverStatus($receiverUser->id);

        //check if the friendshipRequest already exists
        if ($friendshipRequest) {
            if ($friendshipRequest->status == FriendshipStatus::DECLINED->value) {
                $friendshipRequest->update([
                    'status' => FriendshipStatus::PENDING->value,
                    'updated_at' => now(),
                ]);
            }
            return $friendshipRequest; // always return object (even if not updated)
        }

        return Friendship::create([
            'sender_id' => $authedUser->id,
            'receiver_id' => $receiverUser->id,
            'status' => FriendshipStatus::PENDING->value,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
