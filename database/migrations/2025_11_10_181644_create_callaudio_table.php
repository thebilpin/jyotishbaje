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
        Schema::create('callaudio', function (Blueprint $table) {
            $table->id();
            $table->string('callId')->nullable();
            $table->longText('file')->nullable();
            $table->longText('channelName')->nullable();
            $table->string('sId', 400)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('callaudio');
    }
};











