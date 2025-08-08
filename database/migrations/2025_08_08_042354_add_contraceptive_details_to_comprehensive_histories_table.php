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
        Schema::table('comprehensive_histories', function (Blueprint $table) {
            $table->text('contraceptive_pills_details')->nullable()->after('contraceptive_other');
            $table->text('contraceptive_depo_details')->nullable()->after('contraceptive_pills_details');
            $table->text('contraceptive_implant_details')->nullable()->after('contraceptive_depo_details');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comprehensive_histories', function (Blueprint $table) {
            $table->dropColumn([
                'contraceptive_pills_details',
                'contraceptive_depo_details',
                'contraceptive_implant_details'
            ]);
        });
    }
};
