<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Listings;
use Illuminate\Database\Seeder;
use App\Models\User;

use Database\Factories\ListingsFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         $user = User::factory()->create([
            'name' => "John",
            'email' => 'john@email.com'
         ]);

         \App\Models\Listings::factory(6)->create([
            'user_id' => $user->id
         ]);
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
