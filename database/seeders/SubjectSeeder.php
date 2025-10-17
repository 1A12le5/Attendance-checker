<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Subject::create([
            'name' => 'Mathematics',
            'code' => 'MATH101',
            'description' => 'Introduction to Mathematics',
        ]);

        \App\Models\Subject::create([
            'name' => 'English Literature',
            'code' => 'ENG201',
            'description' => 'Study of English Literature',
        ]);

        \App\Models\Subject::create([
            'name' => 'Computer Science',
            'code' => 'CS301',
            'description' => 'Programming and Algorithms',
        ]);
        \App\Models\Subject::create([
            'name'=> 'Infromatios Assurance',
            'code'=> 'F56',
            'description'=> 'Programing',
            ]);
    }
}
