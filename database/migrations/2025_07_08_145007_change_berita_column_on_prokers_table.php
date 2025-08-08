<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('prokers', function (Blueprint $table) {
            $table->string('berita')->change(); // jika awalnya TEXT atau LONGTEXT
        });
    }

    public function down(): void
    {
        Schema::table('prokers', function (Blueprint $table) {
            $table->text('berita')->change(); // balik ke text jika undo
        });
    }
};
