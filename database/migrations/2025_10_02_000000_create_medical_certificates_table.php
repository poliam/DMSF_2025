<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_certificates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
            $table->date('date_issued');
            $table->string('certificate_type'); // fitness_work, medical_leave, travel_clearance, school_sports, custom
            $table->string('purpose');
            $table->date('valid_until')->nullable();
            $table->string('issuing_doctor');
            $table->string('license_number')->nullable();
            $table->text('medical_findings')->nullable();
            $table->text('recommendations')->nullable();
            $table->boolean('digital_signature')->default(false);
            $table->enum('status', ['active', 'revoked', 'expired'])->default('active');
            $table->text('revocation_reason')->nullable();
            $table->timestamp('revoked_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medical_certificates');
    }
};
