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
        Schema::table('officials', function (Blueprint $table) {
            $table->string('birth_place_date')->nullable();
            $table->string('movement_focus')->nullable();
            $table->string('service_period')->nullable();
            $table->text('motto')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('officials', function (Blueprint $table) {
            $table->dropColumn(['birth_place_date', 'movement_focus', 'service_period', 'motto']);
        });
    }
};
