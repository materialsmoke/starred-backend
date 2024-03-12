<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Location::insert([
            ['name' => 'Copenhagen'],
            ['name' => 'Aarhus'],
            ['name' => 'Aalborg'],
            ['name' => 'Odense'],
            ['name' => 'Esbjerg'],
            ['name' => 'Herning'],
        ]);
    }
}
