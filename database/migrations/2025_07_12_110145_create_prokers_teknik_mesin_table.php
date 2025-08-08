<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('prokers_teknik_mesin', function (Blueprint $table) {
            $table->id();
            $table->string('kategori')->nullable();
            $table->string('nama_proker');
            $table->string('ketupel');
            $table->date('tanggal');
            $table->string('proposal')->nullable(); // nama file
            $table->string('status')->nullable();   // status bisa "pending", "revisi", dll
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prokers_teknik_mesin');
    }
};
