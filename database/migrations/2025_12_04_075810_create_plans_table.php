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
    Schema::create('plans', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('slug')->unique();
        $table->text('description')->nullable();

        $table->unsignedInteger('price_monthly'); 
        $table->unsignedInteger('price_yearly')->nullable();
        $table->string('currency', 3)->default('IDR');

        $table->boolean('is_active')->default(true);

        $table->unsignedInteger('max_projects')->nullable();
        $table->unsignedInteger('max_users')->nullable();

        $table->json('data')->nullable(); 
        $table->unsignedInteger('sort_order')->default(0);

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
