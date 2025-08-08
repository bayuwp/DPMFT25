<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('prokers', function (Blueprint $table) {
        $table->renameColumn('terlaksana', 'status');
    });
}

public function down()
{
    Schema::table('prokers', function (Blueprint $table) {
        $table->renameColumn('status', 'terlaksana');
    });
}

};
