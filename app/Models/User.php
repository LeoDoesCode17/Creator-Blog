<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use PDO;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    //define many to many relationship with User model where the relational table is Friendship table

    //the user is the sender of the friendship request
    public function sentFriendRequest(): BelongsToMany {
        //this is a join operation
        return $this->belongsToMany(
            User::class,
            'friendships',
            'sender_id',
            'receiver_id'
        )->wherePivot('status', 'accepted');
    }

    //the user is the receiver of another users friendship request
    public function receivedFriendRequest(): BelongsToMany {
        return $this->belongsToMany(
            User::class,
            'friendships',
            'receiver_id',
            'sender_id'
        )->wherePivot('status', 'accepted');
    }

    public function allAsArray(){
        $users = User::all();
        $usersData = [];
        foreach($users as $user){
            $usersData[$user->id] = [
                'name' => $user->name,
                'username' => $user->username,
            ]; 
        }
        return $usersData;
    }

    //get all the friends of a user
    public function getFriends(){
        //merge the two collections
        return $this->sentFriendRequest->merge($this->receivedFriendRequest);
    }

    /**
     * Scope a query to search for users by name.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query The query builder instance.
     * @param string $term The search term to filter user names.
     * @return \Illuminate\Database\Eloquent\Builder The modified query builder instance.
     */
    public function scopeSearch($query, $term){
        return $query->where('name', 'LIKE', '%'.$term.'%');
    }
}
