<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('prokers_sipil', function (Blueprint $table) {
            $table->id();
            $table->string('kategori')->nullable();
            $table->string('nama_proker');
            $table->string('ketupel');
            $table->date('tanggal');
            $table->string('proposal')->nullable();
            $table->string('lpj')->nullable(); // tambahkan LPJ juga jika diperlukan
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prokers_sipil');
    }
};
