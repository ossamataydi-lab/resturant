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
        Schema::create('settings', function (Blueprint $table) {
        $table->id();
        $table->string('name')->default('');
        $table->string('description')->nullable();
        $table->string('logo')->nullable();
        // Contact and location
        $table->string('phone')->default('');
        $table->string('whatsapp')->nullable();
        $table->string('instgrame')->nullable();
        $table->string('address')->nullable();


        $table->decimal('lat', 10, 8)->nullable();
        $table->decimal('lng', 11, 8)->nullable();

        // Operational Settings
        $table->boolean('is_active')->default(true);
        $table->integer('prep_time')->default(30);
        $table->decimal('min_order', 8, 2)->default(0);
        $table->decimal('delivery_radius', 8, 2)->nullable();


        $table->json('opening_hours')->nullable();
        $table->string('email')->nullable();
        $table->string('adresse')->nullable();
       $table->string('signe_price')->nullable();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
