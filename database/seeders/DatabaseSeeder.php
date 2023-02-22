<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
         \App\Models\Category::factory(30)->create();
         \App\Models\SubCategory::factory(30)->create();
         \App\Models\Brand::factory(30)->create();
         \App\Models\Tag::factory(30)->create();
         \App\Models\Product::factory(30)->create();

        \App\Models\User::factory()->create([
            'name' => 'User 1',
            'email' => 'user1@example.com',
            'password' => hash::make('1234'),
        ]);
    }
}
