<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProkersTable extends Migration
{
    public function up()
    {
        Schema::create('prokers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengawasan_id')->constrained()->onDelete('cascade'); // Relasi ke HMP
            $table->string('nama'); // Nama Proker
            $table->string('berita')->nullable(); // Keterangan berita
            $table->boolean('terlaksana')->default(false); // Status terlaksana
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('prokers');
    }
}
