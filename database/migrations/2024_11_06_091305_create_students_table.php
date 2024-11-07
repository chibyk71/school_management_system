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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('middle_name')->nullable();
            $table->date('date_of_birth');
            $table->string('gender');
            $table->string('registration_number')->unique();
            $table->string('address')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('email')->nullable()->unique();
            $table->foreignId('grade_id')->constrained()->onDelete('cascade'); // Foreign key to grades table
            $table->foreignId('parent_id')->nullable()->constrained('parents')->onDelete('set null'); // Foreign key to parents table
            $table->string('nationality')->nullable();
            $table->date('enrollment_date')->default(now());
            $table->boolean('is_active')->default(true); // Track active/inactive students

            // Tracking columns
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('deleted_by')->nullable()->constrained('users')->onDelete('set null');

            $table->timestamps();
            $table->softDeletes(); // For soft deletes
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
