<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('feedbacks', function (Blueprint $table) {
            if (!Schema::hasColumn('feedbacks', 'subject')) {
                $table->string('subject')->default('Laporan Umum')->after('name');
            }
            if (!Schema::hasColumn('feedbacks', 'contact')) {
                $table->string('contact')->nullable()->after('subject');
            }
            if (!Schema::hasColumn('feedbacks', 'is_read')) {
                $table->boolean('is_read')->default(false)->after('message');
            }
        });

        // Add icon column to statistics if missing
        Schema::table('statistics', function (Blueprint $table) {
            if (!Schema::hasColumn('statistics', 'icon')) {
                $table->string('icon')->nullable()->after('value');
            }
        });
    }

    public function down(): void
    {
        Schema::table('feedbacks', function (Blueprint $table) {
            $table->dropColumn(['subject', 'contact', 'is_read']);
        });
        Schema::table('statistics', function (Blueprint $table) {
            $table->dropColumn('icon');
        });
    }
};
