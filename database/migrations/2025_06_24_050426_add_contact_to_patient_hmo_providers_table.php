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
            $table->string('contact_person')->after('name_slug')->nullable();
            $table->string('contact_person_phone')->after('contact_person')->nullable();
            $table->string('contact_person_email')->after('contact_person_phone')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('patient_hmo_providers', function (Blueprint $table) {
            $table->dropColumn('contact_person');
            $table->dropColumn('contact_person_phone');
            $table->dropColumn('contact_person_email');
        });
    }
};
