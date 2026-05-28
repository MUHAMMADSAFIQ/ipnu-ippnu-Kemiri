<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('candidates', function (Blueprint $table) {
            $table->integer('nomor_urut')->nullable()->after('id');
            $table->string('asal_ranting')->nullable()->after('photo');
            $table->string('jabatan_sebelumnya')->nullable()->after('asal_ranting');
            $table->string('jenis_kelamin')->nullable()->after('jabatan_sebelumnya'); // L / P
            $table->string('angkatan')->nullable()->after('jenis_kelamin'); // tahun masuk / angkatan
        });
    }

    public function down(): void
    {
        Schema::table('candidates', function (Blueprint $table) {
            $table->dropColumn(['nomor_urut', 'asal_ranting', 'jabatan_sebelumnya', 'jenis_kelamin', 'angkatan']);
        });
    }
};
