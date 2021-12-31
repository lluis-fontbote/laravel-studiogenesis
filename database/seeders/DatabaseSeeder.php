<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Photo;
use App\Models\Price;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
        \App\Models\User::create([
            'name' => 'Lluís', 
            'surname' => 'Fontboté', 
            'photo' => 'default.png', 
            'email' => 'lluis.fontbote@studiogenesis.es', 
            'password' => Hash::make('1234'), 
            'is_admin' => true
        ]);
        \App\Models\Product::factory()
                           ->has(Photo::factory()->count(2))
                           ->has(Price::factory()->count(3))
                           ->has(Category::factory()->count(10))
                           ->create();
    }
}
