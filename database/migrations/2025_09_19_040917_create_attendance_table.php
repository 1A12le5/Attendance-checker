<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('attendance', function (Blueprint $table) {
            $table->id();
            $table->date('date')->comment('Attendance date');
            $table->foreignId('student_id')
                  ->constrained('users', 'id') // Explicit reference
                  ->onDelete('cascade')
                  ->comment('References users.id');
            $table->enum('status', ['present', 'absent', 'late'])->default('present');
            $table->timestamps();

            // Indexes for performance
            $table->index('date'); // Optimize date-based queries
            $table->index('student_id'); // Optimize student-based queries
            $table->unique(['student_id', 'date'], 'unique_student_attendance_per_day'); // Prevent duplicate entries per student per day
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance');
    }
};
