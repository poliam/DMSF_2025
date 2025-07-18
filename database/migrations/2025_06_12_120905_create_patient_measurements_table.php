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
        Schema::create('patient_measurements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->onDelete('cascade');
            $table->date('measurement_date');
            $table->integer('tab_number'); // 1, 2, or 3 to identify which tab
            
            // Anthropometric measurements
            $table->decimal('height', 5, 2)->nullable(); // Height in meters
            $table->decimal('weight_kg', 5, 2)->nullable();
            $table->decimal('waist_circumference', 5, 2)->nullable();
            $table->decimal('hip_circumference', 5, 2)->nullable();
            $table->decimal('neck_circumference', 5, 2)->nullable();
            
            // Vital signs
            $table->decimal('temperature', 4, 1)->nullable();
            $table->integer('heart_rate')->nullable();
            $table->integer('o2_saturation')->nullable();
            $table->integer('respiratory_rate')->nullable();
            $table->string('blood_pressure', 10)->nullable();
            
            $table->timestamps();
            
            // Unique constraint to ensure only one measurement per patient per tab
            $table->unique(['patient_id', 'tab_number'], 'patient_measurements_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_measurements');
    }
};
