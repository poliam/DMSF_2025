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
        Schema::table('physical_examinations', function (Blueprint $table) {
            // Drop the existing unique constraint on patient_id
            $table->dropUnique(['patient_id']);
            
            // Add a composite unique constraint on patient_id and consultation_id
            // This allows multiple physical examination records per patient (one per consultation)
            $table->unique(['patient_id', 'consultation_id'], 'pe_patient_consultation_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('physical_examinations', function (Blueprint $table) {
            // Drop the composite unique constraint
            $table->dropUnique('pe_patient_consultation_unique');
            
            // Restore the original unique constraint on patient_id
            $table->unique(['patient_id']);
        });
    }
};
