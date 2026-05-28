<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->text('description')->nullable()->after('name');
            $table->string('category')->default('Lainnya')->after('description');
            $table->integer('discount')->nullable()->after('price');
            $table->string('condition')->default('Baru')->after('discount');
            $table->integer('stock')->default(0)->after('condition');
            $table->string('location')->nullable()->after('stock');
            $table->integer('sold_count')->default(0)->after('location');
            $table->decimal('rating', 2, 1)->default(5.0)->after('sold_count');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['description', 'category', 'discount', 'condition', 'stock', 'location', 'sold_count', 'rating']);
        });
    }
};
