<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(LocationSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(CompanySeeder::class);
        $this->call(JobTypeSeeder::class);
        $this->call(JobSeeder::class);
        $this->call(FavoriteSeeder::class); 

        // \App\Models\User::factory(10)->create();
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
