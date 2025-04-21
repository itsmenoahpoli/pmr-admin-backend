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
        Schema::table('patient_hmo_providers', function (Blueprint $table) {
            $table->string('name_slug')->unique()->after('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('patient_hmo_providers', function (Blueprint $table) {
            $table->dropColumn('name_slug');
        });
    }
};
