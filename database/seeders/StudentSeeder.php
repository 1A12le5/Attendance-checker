<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Student::create([
            'name' => 'John',
            'email' => 'john@gmail.com',
            'student_number' => 'STU001',
        ]);

        \App\Models\Student::create([
            'name' => 'Jane ',
            'email' => 'jane@gmail.com.com',
            'student_number' => 'STU002',
        ]);

        \App\Models\Student::create([
            'name' => 'Bob',
            'email' => 'bob@gmail.com',
            'student_number' => 'STU003',
        ]);
    }
}
