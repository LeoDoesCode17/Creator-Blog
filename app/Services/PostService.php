<?php

namespace App\Services;

use App\Models\Post;
use App\Repositories\Contracts\{PostRepositoryInterface, FriendshipRepositoryInterface};
use App\Models\User;

class PostService
{
    public function __construct(
        private PostRepositoryInterface $postRepository,
        private FriendshipRepositoryInterface $friendshipRespository
    ) {}

    public function getFriendsPosts(User $user, $perPage = 6, $with = [])
    {
        //get friends of $user
        $acceptedFriendship = $this->friendshipRespository->getAcceptedFriendshipRequest($user);

        $friendsIds = $acceptedFriendship->map(function ($friendship) use ($user) {
            return $friendship->sender_id == $user->id ? $friendship->receiver_id : $friendship->sender_id;
        })->push($user->id);

        return $this->postRepository->getPostsByAuthors($friendsIds, $perPage, $with);
    }
}
