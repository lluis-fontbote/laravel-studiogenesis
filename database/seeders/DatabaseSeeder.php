<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Photo;
use App\Models\Price;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();
        \App\Models\Product::factory()
                           ->has(Photo::factory()->count(2))
                           ->has(Price::factory()->count(3))
                           ->has(Category::factory()->count(3))
                           ->create();
    }
}
