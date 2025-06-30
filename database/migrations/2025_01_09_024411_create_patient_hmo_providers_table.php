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
        Schema::create('patient_hmo_providers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('logo_src')->nullable();
            $table->string('contact_person');
            $table->string('contact_person_email');
            $table->string('contact_person_phone');
            $table->boolean('is_enabled')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_hmo_providers');
    }
};
