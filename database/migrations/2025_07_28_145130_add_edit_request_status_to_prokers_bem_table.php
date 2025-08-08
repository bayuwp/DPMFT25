<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('prokers_bem', function (Blueprint $table) {
            $table->enum('edit_request_status', ['none', 'pending', 'approved', 'rejected'])
                ->default('none')
                ->after('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prokers_bem', function (Blueprint $table) {
            table->dropColumn('edit_request_status');
        });
    }
};
