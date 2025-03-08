<?php

namespace Database\Factories;

use App\Models\Friendship;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Friendship>
 */
class FriendshipFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Friendship::class;

    public function definition(): array
    {   
        return [
            'status' => $this->faker->randomElement(['pending', 'accepted', 'declined', 'blocked']),
        ];
    }
}
