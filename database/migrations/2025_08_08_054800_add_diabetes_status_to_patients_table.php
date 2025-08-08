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
            // Drop the existing diagnosis column
            $table->dropColumn('diagnosis');
            
            // Add the new diabetes_status enum column
            $table->enum('diabetes_status', [
                'Not Diabetic',
                'Prediabetes', 
                'DM Type I',
                'DM Type II',
                'Gestational DM',
                'Other Hyperglycemic States',
                'Pending'
            ])->default('Pending');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('patients', function (Blueprint $table) {
            // Drop the diabetes_status column
            $table->dropColumn('diabetes_status');
            
            // Restore the original diagnosis column
            $table->text('diagnosis')->nullable();
        });
    }
};
