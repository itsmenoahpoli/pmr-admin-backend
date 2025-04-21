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
        Schema::create('patient_appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_profile_id')->constrained('patient_profiles')->cascadeOnDelete();
            $table->string('date');
            $table->string('time');
            $table->text('purpose');
            $table->text('remarks')->nullable();
            $table->enum('type', ['consultation', 'therapy'])->default('consultation');
            $table->enum('status', ['pending', 'done', 'cancelled'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_appointments');
    }
};
