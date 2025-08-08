<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('prokers_tata_busana', function (Blueprint $table) {
            $table->string('status_proposal')->nullable();
            $table->string('status_lpj')->nullable();
            $table->string('lpa')->nullable();
            $table->string('rundown_kegiatan')->nullable();
            $table->string('absensi_panitia')->nullable();
            $table->string('absensi_peserta')->nullable();
            $table->string('absensi_tamu_undangan')->nullable();
            $table->string('instrumen_materi')->nullable();
            $table->string('dokumentasi')->nullable();
            $table->string('time_stap')->nullable();
        });
    }

    public function down()
    {
        Schema::table('prokers_tata_busana', function (Blueprint $table) {
            $table->dropColumn([
                'status_proposal',
                'status_lpj',
                'lpa',
                'rundown_kegiatan',
                'absensi_panitia',
                'absensi_peserta',
                'absensi_tamu_undangan',
                'instrumen_materi',
                'dokumentasi',
                'time_stap',
            ]);
        });
    }
};
