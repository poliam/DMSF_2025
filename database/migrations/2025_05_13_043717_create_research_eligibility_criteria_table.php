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
        Schema::create('research_eligibility_criteria', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->onDelete('cascade');  // Assuming the patient table exists
            $table->boolean('read_and_write_consent')->default(false);  // Read and write ability
            $table->boolean('consent_for_info')->default(false);  // Consent to provide information
            $table->boolean('consent_for_teleconsultation')->default(false);  // Consent for teleconsultation
            $table->boolean('laboratory_finding')->default(false);  // Lab result criteria
            $table->float('fbs_result')->nullable();  // FBS result
            $table->integer('rbs_result')->nullable();  // RBS result
            $table->boolean('polyuria')->default(false);  // Polyuria
            $table->boolean('polydipsia')->default(false);  // Polydipsia
            $table->boolean('polyphagia')->default(false);  // Polyphagia
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('research_eligibility_criteria');
    }
};
