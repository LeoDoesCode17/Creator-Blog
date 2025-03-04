<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::factory()->predefined('Machine Learning')->create();
        Category::factory()->predefined('Cloud Computing')->create();
        Category::factory()->predefined('Internet Of Things')->create();
    }
}
