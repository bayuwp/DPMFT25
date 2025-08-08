<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTerlaksanaColumnInProkersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Pastikan doctrine/dbal sudah terinstall agar bisa melakukan `change()`
        Schema::table('prokers', function (Blueprint $table) {
            $table->boolean('terlaksana')->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Kembalikan ke tipe sebelumnya (misalnya string atau integer)
        Schema::table('prokers', function (Blueprint $table) {
            $table->string('terlaksana')->change(); // sesuaikan tipe asalnya jika beda
        });
    }
}
