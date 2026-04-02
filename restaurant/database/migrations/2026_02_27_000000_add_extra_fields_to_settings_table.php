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
        Schema::table('settings', function (Blueprint $table) {
            if (!Schema::hasColumn('settings', 'email')) {
                $table->string('email')->nullable()->after('phone');
            }
            if (!Schema::hasColumn('settings', 'instagram')) {
                $table->string('instagram')->nullable()->after('whatsapp');
            }
            if (!Schema::hasColumn('settings', 'adresse')) {
                $table->string('adresse')->nullable()->after('instagram');
            }
            if (!Schema::hasColumn('settings', 'signe_price')) {
                $table->string('signe_price')->nullable()->default('$')->after('min_order');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['email', 'instagram', 'adresse', 'signe_price']);
        });
    }
};
