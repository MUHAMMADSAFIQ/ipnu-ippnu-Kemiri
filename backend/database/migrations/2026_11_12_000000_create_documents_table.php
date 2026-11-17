<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('desc')->nullable();
            $table->string('category')->default('administrasi'); // 'kaderisasi', 'administrasi', 'regulasi', 'lainnya'
            $table->string('cat_label')->nullable();
            $table->string('file_type')->default('PDF');
            $table->string('file_size')->nullable();
            $table->string('icon')->default('fa-file-pdf');
            $table->string('color')->default('#dc2626');
            $table->string('file_path')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('download_count')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};

