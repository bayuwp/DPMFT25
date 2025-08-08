<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameNamaToNamaProkerInProkersTable extends Migration
{
    public function up()
    {
        Schema::table('prokers', function (Blueprint $table) {
            $table->renameColumn('nama', 'nama_proker');
        });
    }

    public function down()
    {
        Schema::table('prokers', function (Blueprint $table) {
            $table->renameColumn('nama_proker', 'nama');
        });
    }
}

