<?php

namespace App\Repositories\Eloquent;

use App\Models\Friendship;
use App\Models\User;
use App\Repositories\Contracts\FriendshipRepositoryInterface;
use App\Enums\FriendshipStatus;
use App\Exceptions\FriendshipNotFoundException;

class FriendshipRepository implements FriendshipRepositoryInterface
{
    /**
     * Get information about the friendship request between the authenticated user and the visited user.
     *
     * This function checks if there is any friendship request between the authenticated user and 
     * the visited user, regardless of who is the sender or receiver.
     *
     * It returns an object containing:
     * - `friendship` → The friendship request model (if exists), or null if not found.
     * - `isSender` → A boolean indicating whether the authenticated user is the sender:
     *      - true  → if authenticated user sent the request.
     *      - false → if authenticated user received the request.
     *      - null  → if there is no friendship request between them.
     *
     * @param User $authedUser   The authenticated user who is visiting the profile.
     * @param User $visitedUser  The visited user whose profile is being viewed.
     *
     * @return object {
     *     friendship: Friendship|null,
     *     isSender: bool|null
     * }
     */
    public function getFriendshipBetween(User $authedUser, User $visitedUser)
    {
        $authedAsSender = $authedUser->getFriendshipReceiverStatus($visitedUser->id);
        $authedAsReceiver = $visitedUser->getFriendshipReceiverStatus($authedUser->id);
        return (object)[
            'friendship' => $authedAsSender ?? $authedAsReceiver,
            'isSender' => $authedAsSender ? true : ($authedAsReceiver ? false : null),
        ];
    }

    /**
     * Upsert (create or update) a friendship request between two users.
     *
     * Flow logic:
     * - If there is no existing friendship request between $authedUser and $visitedUser → create a new request (PENDING status).
     * - If there is an existing friendship request with DECLINED status → update it to:
     *      - sender_id: $authedUser
     *      - receiver_id: $visitedUser
     *      - status: PENDING
     * - If there is an existing friendship request (other than DECLINED) → do nothing (just return it).
     *
     * @param User $authedUser  The authenticated user (request sender).
     * @param User $visitedUser The target user (request receiver).
     *
     * @return Friendship The created or existing Friendship model instance.
     */
    public function upsertFriendshipRequest(User $authedUser, User $visitedUser)
    {
        $betweenAuthedAndVisited = $this->getFriendshipBetween($authedUser, $visitedUser);
        $friendshipRequest = $betweenAuthedAndVisited->friendship;

        if (!$friendshipRequest) {
            return Friendship::create([
                'sender_id' => $authedUser->id,
                'receiver_id' => $visitedUser->id,
                'status' => FriendshipStatus::PENDING->value,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        if ($friendshipRequest->status == FriendshipStatus::DECLINED->value) {
            $friendshipRequest->update([
                'sender_id' => $authedUser->id,
                'receiver_id' => $visitedUser->id,
                'status' => FriendshipStatus::PENDING->value,
            ]);
        }
        return $friendshipRequest; // always return object (even if not updated)
    }

    /**
     * Update the friendship request status sent by the target user to the authenticated user.
     *
     * This method is used when the authenticated user visits the profile page of a target user
     * who has previously sent a friendship request. The authenticated user (as the receiver)
     * can respond to that request by accepting, declining, or blocking it.
     *
     * Flow:
     * - Search for a friendship request where the sender is the target user
     *   and the receiver is the authenticated user.
     * - If found, update its status to the provided value.
     * - If not found, throw FriendshipNotFoundException.
     *
     * @param User   $authedUser  The authenticated user (receiver of the friendship request).
     * @param User   $targetUser  The target user (sender of the friendship request).
     * @param string $status      The new status to be set (e.g., accepted, declined, blocked).
     *
     * @throws FriendshipNotFoundException  If the friendship request from target user to authenticated user does not exist.
     *
     * @return Friendship  The updated Friendship model.
     */
    private function updateFriendshipRequest(User $authedUser, User $targetUser, $status)
    {
        $friendshipRequest = $targetUser->getFriendshipReceiverStatus($authedUser->id);

        if (!$friendshipRequest) {
            throw new FriendshipNotFoundException();
        }

        $friendshipRequest->update([
            'status' => $status,
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
