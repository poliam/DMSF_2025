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
        Schema::create('referral_forms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
            $table->date('referral_date');
            $table->enum('priority', ['routine', 'urgent', 'emergency'])->default('routine');
            $table->string('specialty');
            $table->string('referred_doctor');
            $table->string('institution')->nullable();
            $table->string('contact_info')->nullable();
            $table->text('reason_for_referral');
            $table->text('relevant_history')->nullable();
            $table->text('urgency_reason')->nullable();
            $table->boolean('include_reports')->default(false);
            $table->enum('status', ['pending', 'completed', 'cancelled', 'in_progress'])->default('pending');
            $table->text('tracking_notes')->nullable();
            $table->date('appointment_date')->nullable();
            $table->text('outcome')->nullable();
            $table->string('referring_doctor')->nullable();
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
        Schema::dropIfExists('referral_forms');
    }
};
