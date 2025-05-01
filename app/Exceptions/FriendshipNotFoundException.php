<?php

namespace App\Exceptions;

use Exception;

class FriendshipNotFoundException extends Exception
{
    // this exception is thrown when a friendship request is not found
    public function __construct($message = 'Friendship request not found')
    {
        parent::__construct($message);
    }
}