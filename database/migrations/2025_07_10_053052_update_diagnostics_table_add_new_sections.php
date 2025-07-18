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
        Schema::table('diagnostics', function (Blueprint $table) {
            $table->json('stool_tests')->nullable()->after('immunology_serology');
            $table->json('blood_typing_bsmp')->nullable()->after('stool_tests');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('diagnostics', function (Blueprint $table) {
            $table->dropColumn(['stool_tests', 'blood_typing_bsmp']);
        });
    }
};
