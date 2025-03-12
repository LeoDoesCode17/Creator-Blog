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
    public function sender(){
        return $this->belongsTo(User::class, 'user_id');
    }

    //to get the receiver of a friendship
    public function receiver(){
        return $this->belongsTo(User::class, 'friend_id');
    }
}
