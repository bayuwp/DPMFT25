<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('pengawasan_pkkmbs', function (Blueprint $table) {
        $table->id();
        $table->date('tanggal');
        $table->string('berita')->nullable(); // path file
        $table->string('dokumentasi')->nullable(); // path image
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengawasan_pkkmbs');
    }
};
