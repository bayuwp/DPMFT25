<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $tables = [
            'bph',
            'komisi_1',
            'komisi_2',
            'komisi_3',
            'komisi_4',
        ];

        foreach ($tables as $table) {
            Schema::create($table, function (Blueprint $table) {
                $table->id();
                $table->string('nama');
                $table->string('jabatan');
                $table->string('foto')->nullable();
                $table->text('deskripsi')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('bph');
        Schema::dropIfExists('komisi_1');
        Schema::dropIfExists('komisi_2');
        Schema::dropIfExists('komisi_3');
        Schema::dropIfExists('komisi_4');
    }
};
