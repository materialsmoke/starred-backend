<?php

namespace Database\Seeders;

use App\Models\JobType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JobType::insert([
            ['name' => 'full_time'],
            ['name' => 'part_time'],
            ['name' => 'remote_full_time'],
            ['name' => 'remote_part_time'],
        ]);
    }
}
