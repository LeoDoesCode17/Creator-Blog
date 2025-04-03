<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friendship extends Model
{
    /** @use HasFactory<\Database\Factories\FriendshipFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'friend_id',
        'status'
    ];

    //to get the sender of a friendship
    public function sender()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    //to get the receiver of a friendship
    public function receiver()
    {
        return $this->belongsTo(User::class, 'friend_id');
    }

    /**
     * Retrieve the relationship between two users based on their IDs.
     *
     * This method checks for a friendship relationship between the sender and receiver
     * by querying the database using the query builder. It considers both directions
     * of the relationship (sender to receiver and receiver to sender).
     *
     * @param int $sender_id The ID of the sender.
     * @param int $receiver_id The ID of the receiver.
     * @return \App\Models\Friendship|null The friendship relationship if found, or null if not found.
     */
    public static function getRelationship($sender_id, $receiver_id) 
    {
        //this is using query builder
        return self::where(function($query) use ($sender_id, $receiver_id){
            $query->where('sender_id', $sender_id)->where('receiver_id', $receiver_id);
        })->orWhere(function($query) use($sender_id, $receiver_id){
            $query->where('sender_id', $receiver_id)->where('receiver_id', $sender_id);
        })->first();
    }
}
