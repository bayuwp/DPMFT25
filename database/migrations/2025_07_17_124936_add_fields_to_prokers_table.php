<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToProkersTable extends Migration
{
    public function up()
    {
        Schema::table('prokers', function (Blueprint $table) {
            $table->date('tanggal')->nullable()->after('nama'); // tanggal kegiatan
            $table->time('waktu')->nullable()->after('tanggal'); // waktu kegiatan
            $table->string('tempat')->nullable()->after('waktu'); // tempat kegiatan
            $table->string('penanggung_jawab')->nullable()->after('tempat'); // PJ kegiatan
        });
    }

    public function down()
    {
        Schema::table('prokers', function (Blueprint $table) {
            $table->dropColumn(['tanggal', 'waktu', 'tempat', 'penanggung_jawab']);
        });
    }
}
