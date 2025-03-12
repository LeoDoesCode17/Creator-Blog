<?php

namespace Database\Seeders;

use App\Models\Friendship;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FriendshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //get all the users
        $users = User::all();

        if($users->count() < 2){
            return ;
        }

        foreach($users as $user){
            //pick random friend (excluding self)
            $friend = User::where('id', '!=', $user->id)->inRandomOrder()->first();

            //make sure friendship doesn't exists in both direction
            $friendshipExists = Friendship::where(
                function ($query) use($user, $friend){
                    $query->where('sender_id', $user->id)->where('receiver_id', $friend->id);
                }
            )->orWhere(
                function ($query) use($user, $friend){
                    $query->where('sender_id', $friend->id)->where('receiver_id', $user->id);
                }
            )->exists();

            //if doesn't exist => create using factory
            if(!$friendshipExists){
                Friendship::factory()->create([
                    'sender_id' => $user->id,
                    'receiver_id' => $friend->id
                ]);
            }
        }
    }
}
