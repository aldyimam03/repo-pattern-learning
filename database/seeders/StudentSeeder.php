<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = [
            ['name' => 'Alucard', 'age' => 21, 'room_id' => 1], // Kelas A
            ['name' => 'Brody', 'age' => 20, 'room_id' => 2],   // Kelas B
            ['name' => 'Cecilion', 'age' => 22, 'room_id' => 3], // Kelas C
            ['name' => 'Dyrroth', 'age' => 23, 'room_id' => 4], // Kelas D
            ['name' => 'Esmeralda', 'age' => 19, 'room_id' => 5], // Kelas E
            ['name' => 'Angela', 'age' => 20, 'room_id' => 1],  // Kelas A
            ['name' => 'Benedetta', 'age' => 21, 'room_id' => 2], // Kelas B
            ['name' => 'Claude', 'age' => 20, 'room_id' => 3],  // Kelas C
            ['name' => 'Diggie', 'age' => 24, 'room_id' => 4],  // Kelas D
            ['name' => 'Estes', 'age' => 19, 'room_id' => 5],   // Kelas E
        ];

        foreach ($students as $student) {
            Student::create($student);
        }
    }
}
