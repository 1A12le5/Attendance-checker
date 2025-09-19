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
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., "Mathematics", "English"
            $table->string('code')->unique()->nullable(); // e.g., "MATH101", optional but helpful
            $table->text('description')->nullable(); // Optional details about the subject
            $table->foreignId('teacher_id')->nullable()->constrained('users')->onDelete('set null');
                // Assuming teachers are stored in 'users' table with role='teacher'
            $table->timestamps();

            // Optional: Add index for faster searches
            $table->index('name');
            $table->index('code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};
