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

        // 🔹 Hapus kolom
        foreach ($tables as $tbl) {
            if (Schema::hasColumn($tbl, 'logo_kabinet') ||
                Schema::hasColumn($tbl, 'foto_fungsionaris') ||
                Schema::hasColumn($tbl, 'nama_kabinet')) {

                Schema::table($tbl, function (Blueprint $blueprint) use ($tbl) {
                    if (Schema::hasColumn($tbl, 'logo_kabinet')) {
                        $blueprint->dropColumn('logo_kabinet');
                    }
                    if (Schema::hasColumn($tbl, 'foto_fungsionaris')) {
                        $blueprint->dropColumn('foto_fungsionaris');
                    }
                    if (Schema::hasColumn($tbl, 'nama_kabinet')) {
                        $blueprint->dropColumn('nama_kabinet');
                    }
                });
            }
        }

        // 🔹 Rename kolom
        foreach ($tables as $tbl) {
            if (Schema::hasColumn($tbl, 'deskripsi_jurusan')) {
                Schema::table($tbl, function (Blueprint $blueprint) {
                    $blueprint->renameColumn('deskripsi_jurusan', 'deskripsi_proker');
                });
            }
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

        // 🔹 Tambahkan kembali kolom yang dihapus
        foreach ($tables as $tbl) {
            Schema::table($tbl, function (Blueprint $blueprint) use ($tbl) {
                if (!Schema::hasColumn($tbl, 'logo_kabinet')) {
                    $blueprint->string('logo_kabinet')->nullable();
                }
                if (!Schema::hasColumn($tbl, 'foto_fungsionaris')) {
                    $blueprint->string('foto_fungsionaris')->nullable();
                }
                if (!Schema::hasColumn($tbl, 'nama_kabinet')) {
                    $blueprint->string('nama_kabinet')->nullable();
                }
            });
        }

        // 🔹 Rename balik kolom
        foreach ($tables as $tbl) {
            if (Schema::hasColumn($tbl, 'deskripsi_proker')) {
                Schema::table($tbl, function (Blueprint $blueprint) {
                    $blueprint->renameColumn('deskripsi_proker', 'deskripsi_jurusan');
                });
            }
        }
    }
};
