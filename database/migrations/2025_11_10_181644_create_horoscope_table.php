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
        Schema::create('horoscope', function (Blueprint $table) {
            $table->id();
            $table->string('horoscopeType', 100)->nullable();
            $table->string('title', 200)->nullable();
            $table->longText('description')->nullable();
            $table->string('horoscopeSignId')->nullable();
            $table->string('created_at')->useCurrent()->nullable();
            $table->string('updated_at')->useCurrent()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horoscope');
    }
};











