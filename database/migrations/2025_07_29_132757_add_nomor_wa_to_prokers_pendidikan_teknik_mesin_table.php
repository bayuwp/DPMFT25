<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('prokers_pendidikan_teknik_mesin', function (Blueprint $table) {
            $table->string('nomor_wa')->nullable()->after('ketupel');
        });
    }

    public function down(): void
    {
        Schema::table('prokers_pendidikan_teknik_mesin', function (Blueprint $table) {
            $table->dropColumn('nomor_wa');
        });
    }
};

