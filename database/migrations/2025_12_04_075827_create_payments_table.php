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
    Schema::create('payments', function (Blueprint $table) {
        $table->id();

        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('subscription_id')->nullable()
              ->constrained('subscriptions')->onDelete('set null');
        $table->foreignId('plan_id')->nullable()
              ->constrained('plans')->onDelete('set null');

        $table->unsignedInteger('amount');
        $table->string('currency', 3)->default('IDR');

        // pending, paid, failed, refunded
        $table->string('status')->default('pending');

        $table->string('provider'); 
        $table->string('provider_payment_id')->nullable();
        $table->json('provider_raw_response')->nullable();

        $table->string('invoice_number')->unique();
        $table->string('description')->nullable();

        $table->timestamp('paid_at')->nullable();
        $table->timestamp('failed_at')->nullable();
        $table->timestamp('refunded_at')->nullable();

        $table->timestamps();

        $table->index(['user_id', 'status']);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
