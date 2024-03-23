<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Job::factory(20)->create();

        \DB::table('favorites')->insert([
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
