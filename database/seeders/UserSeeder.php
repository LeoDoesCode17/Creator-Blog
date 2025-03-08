<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Leonardo Nifinluri',
            'email' => 'test@gmail.com',
            'password' => bcrypt(env('MY_PASSWORD')),
            'username' => 'Creator09',
        ]);
        User::factory()->count(4)->create();
    }
}
