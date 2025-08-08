<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cabinets', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique(); // slug untuk jurusan
            $table->string('nama_cabinet');
            $table->text('deskripsi_jurusan')->nullable();
            $table->string('logo_cabinet')->nullable(); // simpan path logo
            $table->string('foto_fungsionaris')->nullable(); // simpan path foto
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cabinets');
    }
};
