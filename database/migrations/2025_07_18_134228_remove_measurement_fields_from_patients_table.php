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
        Schema::table('patients', function (Blueprint $table) {
            // Remove measurement fields that are now in patient_measurements table
            $table->dropColumn([
                'weight_kg',
                'waist_circumference',
                'hip_circumference', 
                'neck_circumference',
                'temperature',
                'heart_rate',
                'o2_saturation',
                'respiratory_rate',
                'blood_pressure'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('patients', function (Blueprint $table) {
            // Restore the fields if needed to rollback
            $table->decimal('weight_kg', 5, 2)->nullable();
            $table->decimal('waist_circumference', 5, 2)->nullable();
            $table->decimal('hip_circumference', 5, 2)->nullable();
            $table->decimal('neck_circumference', 5, 2)->nullable();
            $table->decimal('temperature', 4, 1)->nullable();
            $table->integer('heart_rate')->nullable();
            $table->integer('o2_saturation')->nullable();
            $table->integer('respiratory_rate')->nullable();
            $table->string('blood_pressure', 10)->nullable();
        });
    }
};
