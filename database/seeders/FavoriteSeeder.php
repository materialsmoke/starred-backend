<?php

namespace Database\Seeders;

use App\Models\Favorite;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FavoriteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Favorite::insert([
            ['user_id' => 1, 'job_id' => 1],
            ['user_id' => 1, 'job_id' => 3],
            ['user_id' => 1, 'job_id' => 4],
            ['user_id' => 1, 'job_id' => 6],
            ['user_id' => 2, 'job_id' => 1],
            ['user_id' => 2, 'job_id' => 2],
            ['user_id' => 2, 'job_id' => 3],
            ['user_id' => 3, 'job_id' => 1],
            ['user_id' => 3, 'job_id' => 2],
            ['user_id' => 3, 'job_id' => 3],
            ['user_id' => 3, 'job_id' => 6],
            ['user_id' => 3, 'job_id' => 8],
            ['user_id' => 3, 'job_id' => 9],
        ]);
    }
}
