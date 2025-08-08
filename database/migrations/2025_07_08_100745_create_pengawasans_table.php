<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengawasansTable extends Migration
{
    public function up()
    {
        Schema::create('pengawasans', function (Blueprint $table) {
            $table->id();
            $table->string('nama'); // Nama HMP
            $table->string('slug')->unique(); // Slug URL
            $table->text('deskripsi'); // Deskripsi HMP
            $table->string('logo'); // Path logo
            $table->string('foto_proker'); // Path foto proker
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pengawasans');
    }
}
