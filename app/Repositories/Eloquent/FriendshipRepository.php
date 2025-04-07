<?php

namespace App\Repositories\Eloquent;

use App\Models\Friendship;
use App\Models\User;
use App\Repositories\Contracts\FriendshipRepositoryInterface;
use App\Enums\FriendshipStatus;
use App\Exceptions\FriendshipNotFoundException;

class FriendshipRepository implements FriendshipRepositoryInterface
{
    //function to get information about friendship request between authed user and visitedUser and information about whether the authed user is the sender or receiver of the friendship request
    public function between(User $authedUser, User $visitedUser)
    {
        $authedAsSender = $authedUser->getFriendshipReceiverStatus($visitedUser->id);
        $authedAsReceiver = $visitedUser->getFriendshipReceiverStatus($authedUser->id);

        //data means the frienship request model
        return (object)[
            // if authedAsSender not null then store it in friendship else store authedAsReceiver in friendship
            'friendship' => $authedAsSender ?? $authedAsReceiver,
            // if authedAsSender not null then authed user is sender if authedAsReceiver not null authed user is receiver else null
            'isSender' => $authedAsSender ? true : ($authedAsReceiver ? false : null),
        ];
    }

    //this is still bug because if 1->3 exists and 3->1 doesn't, this function will create 3->1 request
    public function upsertFriendshipRequest(User $authedUser, User $receiverUser)
    {
        //this is must be in two direction
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

    private function updateFriendshipRequest(User $authedUser, User $targetUser, $status)
    {
        $friendshipRequest = $targetUser->getFriendshipReceiverStatus($authedUser->id);

        if (!$friendshipRequest) {
            dd($friendshipRequest);
            throw new FriendshipNotFoundException();
        }

        $friendshipRequest->update([
            'status' => $status,
            'updated_at' => now(),
        ]);
        return $friendshipRequest;
    }

    public function acceptFriendshipRequest(User $authedUser, User $targetUser)
    {
        // dd('Accept friend request from ' . $targetUser->name);  
        return $this->updateFriendshipRequest($authedUser, $targetUser, FriendshipStatus::ACCEPTED->value); 
    }

    public function declineFriendshipRequest(User $authedUser, User $targetUser)
    {
        // dd('Decline friend request from ' . $targetUser->name);
        return $this->updateFriendshipRequest($authedUser, $targetUser, FriendshipStatus::DECLINED->value); 
    }

    public function blockFriendshipRequest(User $authedUser, User $targetUser)
    {
        // dd('Block friend request from ' . $targetUser->name);
        return $this->updateFriendshipRequest($authedUser, $targetUser, FriendshipStatus::BLOCKED->value); 
    }
}
