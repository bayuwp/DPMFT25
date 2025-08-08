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
        Schema::table('prokers_te', function (Blueprint $table) {
            $table->string('nomor_wa')->nullable()->after('ketupel');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prokers_te', function (Blueprint $table) {
            $table->dropColumn('nomor_wa');
        });
    }
};
