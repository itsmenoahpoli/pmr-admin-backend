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
        Schema::create('patient_hmos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_profile_id')->constrained('patient_profiles')->cascadeOnDelete();
            $table->foreignId('patient_hmo_provider_id')->nullable()->constrained('patient_hmo_providers')->nullOnDelete();
            $table->string('hmo_account_no');
            $table->string('hmo_policy_no');
            $table->json('hmo_dependents');
            $table->string('card_photo')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_hmos');
    }
};
