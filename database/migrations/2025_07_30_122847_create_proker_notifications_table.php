<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('proker_notifications', function (Blueprint $table) {
            $table->id();
            $table->string('model');
            $table->unsignedBigInteger('proker_id');
            $table->text('message');
            $table->timestamps();

            // Opsional: index untuk mempercepat pencarian
            $table->index(['model', 'proker_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proker_notifications');
    }
};
