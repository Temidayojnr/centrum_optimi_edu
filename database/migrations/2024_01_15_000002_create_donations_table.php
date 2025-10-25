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
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_reference')->unique();
            $table->string('donor_name');
            $table->string('donor_email');
            $table->string('donor_phone')->nullable();
            $table->decimal('amount', 15, 2);
            $table->string('currency', 3)->default('NGN');
            $table->enum('payment_method', ['paystack', 'flutterwave', 'bank_transfer'])->default('paystack');
            $table->enum('status', ['pending', 'successful', 'failed'])->default('pending');
            $table->foreignId('program_id')->nullable()->constrained()->nullOnDelete();
            $table->text('message')->nullable();
            $table->boolean('is_anonymous')->default(false);
            $table->json('payment_data')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
