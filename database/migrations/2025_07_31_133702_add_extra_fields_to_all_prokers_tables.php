<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $tables = [
            'prokers_pendidikan_teknik_mesin',
            'prokers_teknik_mesin',
            'prokers_tata_boga',
            'prokers_tata_busana',
            'prokers_tata_rias',
            'prokers_ti',
            'prokers_pti',
            'prokers_si',
            'prokers_te',
            'prokers_pte',
            'prokers_sipil',
            'prokers_ptb',
            'prokers_pwk',
            'prokers_bem',
        ];

        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->string('agenda_rapat')->nullable();
                $table->string('link_gform_peserta')->nullable();
                $table->string('link_gform_panitia')->nullable();
                $table->string('logo_kabinet')->nullable();
                $table->string('foto_fungsionaris')->nullable();
                $table->text('deskripsi_jurusan')->nullable();
                $table->string('nama_kabinet')->nullable();
                $table->string('berita')->nullable(); // ✅ Simpan nama file berita
            });
        }
    }

    public function down(): void
    {
        $tables = [
            'prokers_pendidikan_teknik_mesin',
            'prokers_teknik_mesin',
            'prokers_tata_boga',
            'prokers_tata_busana',
            'prokers_tata_rias',
            'prokers_ti',
            'prokers_pti',
            'prokers_si',
            'prokers_te',
            'prokers_pte',
            'prokers_sipil',
            'prokers_ptb',
            'prokers_pwk',
            'prokers_bem',
        ];

        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->dropColumn([
                    'agenda_rapat',
                    'link_gform_peserta',
                    'link_gform_panitia',
                    'logo_kabinet',
                    'foto_fungsionaris',
                    'deskripsi_jurusan',
                    'nama_kabinet',
                    'berita',
                ]);
            });
        }
    }
};
