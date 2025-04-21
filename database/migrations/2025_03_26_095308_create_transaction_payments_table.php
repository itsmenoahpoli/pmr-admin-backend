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
        Schema::create('transaction_payments', function (Blueprint $table) {
            $table->id();
            $table->string('uid')->unique();
            $table->float('amount');
            $table->text('description');
            $table->text('remarks')->nullable();
            $table->string('provider_payment_id')->nullable();
            $table->string('provider_payment_type')->nullable();
            $table->text('provider_payment_attributes')->nullable();
            $table->enum('provider', ['paymongo', 'xendit', 'stripe'])->nullable();
            $table->enum('status', ['pending', 'paid', 'cancelled', 'voided', 'refunded']);
            $table->enum('type', ['online', 'cash']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_payments');
    }
};
