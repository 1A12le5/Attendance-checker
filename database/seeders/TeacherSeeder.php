<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Teacher;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Teacher::create([
            'name' => 'JAIRA REYES',
            'email' => 'jaira@example.com',
            'teacher_code' => '23-00125',
        ]);
        Teacher::create([
            'name' => 'Admin Teacher',
            'email' => 'admin@example.com',
            'teacher_code' => 'T001',
        ]);
    }
}
