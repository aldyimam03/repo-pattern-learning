<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Room::create(['name' => 'Kelas A']);
        Room::create(['name' => 'Kelas B']);
        Room::create(['name' => 'Kelas C']);
        Room::create(['name' => 'Kelas D']);
        Room::create(['name' => 'Kelas E']);
    }
}
