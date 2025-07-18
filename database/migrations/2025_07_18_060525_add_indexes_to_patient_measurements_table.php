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
        Schema::table('patient_measurements', function (Blueprint $table) {
            $table->index(['patient_id', 'tab_number', 'measurement_date'], 'pm_patient_tab_date_idx');
            $table->index(['patient_id', 'tab_number'], 'pm_patient_tab_idx');
            $table->index('measurement_date', 'pm_date_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('patient_measurements', function (Blueprint $table) {
            $table->dropIndex('pm_patient_tab_date_idx');
            $table->dropIndex('pm_patient_tab_idx');
            $table->dropIndex('pm_date_idx');
        });
    }
};
