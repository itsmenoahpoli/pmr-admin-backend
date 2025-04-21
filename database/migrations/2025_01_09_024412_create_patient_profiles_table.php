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
        Schema::create('patient_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_hmo_provider_id')->nullable()->constrained('patient_hmo_providers')->nullOnDelete();
            $table->string('uid')->unique();
            $table->string('profile_photo')->nullable()->unique();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->enum('gender', ['male', 'female']);
            $table->string('birthdate');
            $table->string('contact_mobile');
            $table->string('contact_landline')->nullable();
            $table->string('contact_email');
            $table->text('address_line1');
            $table->text('address_line2')->nullable();
            $table->string('address_city');
            $table->string('address_province');
            $table->string('address_zipcode');
            $table->string('address_country')->default('PH');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_profiles');
    }
};
