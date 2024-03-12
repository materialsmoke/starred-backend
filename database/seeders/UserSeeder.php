<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'name' => 'Alex',
                'email' => 'alex@alex.com',
                'password' => '$2y$12$hrM.VtbtouR27vRbTGZxGu31aP92W01Z4SaFko1LvX4I5Lkecv6sq',
            ],
            [
                'name' => 'Ira',
                'email' => 'company@company.com',
                'password' => '$2y$12$hrM.VtbtouR27vRbTGZxGu31aP92W01Z4SaFko1LvX4I5Lkecv6sq',
            ],
            [
                'name' => 'Sam',
                'email' => 'user@user.com',
                'password' => '$2y$12$hrM.VtbtouR27vRbTGZxGu31aP92W01Z4SaFko1LvX4I5Lkecv6sq',
            ],
        ]);
        \App\Models\User::factory(20)->create();
    }
}
