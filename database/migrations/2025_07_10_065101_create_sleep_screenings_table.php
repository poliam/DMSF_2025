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
        Schema::create('sleep_screenings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->onDelete('cascade');
            
            // Sleep Time and Duration
            $table->time('sleep_time')->nullable();
            $table->time('wake_time')->nullable();
            $table->decimal('sleep_duration', 4, 1)->nullable(); // hours with decimal
            $table->integer('sleep_quality')->nullable(); // 1-10 scale
            
            // Sleep Activities (stored as JSON)
            $table->json('sleep_activities')->nullable();
            
            // Daytime Sleepiness
            $table->enum('daytime_sleepiness', ['yes', 'no'])->nullable();
            
            // P-BANG Features
            $table->string('blood_pressure')->nullable();
            $table->decimal('bmi', 5, 2)->nullable();
            $table->integer('age')->nullable();
            $table->decimal('neck_circumference', 5, 1)->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            
            // Assessment Results
            $table->json('recommended_assessments')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sleep_screenings');
    }
};
