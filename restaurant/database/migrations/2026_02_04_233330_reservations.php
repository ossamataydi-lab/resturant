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
     Schema::create('reservations', function (Blueprint $table) {
    $table->id();
    // $table->foreignId('table_id')->nullable()->constrained()->onDelete('cascade');

    $table->string('customer_name');
    $table->string('customer_phone');
    $table->dateTime('reservation_time');
    $table->integer('guests_count');
    $table->text('special_requests')->nullable();
    $table->string('status')->default('pending');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_id');
        Schema::dropIfExists('guest_count');
    }
};
