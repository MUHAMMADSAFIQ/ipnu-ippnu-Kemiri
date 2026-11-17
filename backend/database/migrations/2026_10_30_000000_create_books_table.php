<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('author');
            $table->enum('category', ['aswaja', 'sejarah', 'remaja', 'lainnya'])->default('lainnya');
            $table->string('cat_label')->nullable();
            $table->string('pages')->nullable();
            $table->string('language')->default('Bahasa Indonesia');
            $table->string('color')->default('#15803d');
            $table->text('synopsis')->nullable();
            $table->string('file_path')->nullable(); // path to PDF in storage
            $table->string('cover_path')->nullable(); // optional cover image
            $table->boolean('is_active')->default(true);
            $table->integer('download_count')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
