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
        Schema::create('blockassistant', function (Blueprint $table) {
            $table->id();
            $table->string('assistantId')->nullable();
            $table->string('userId')->nullable();
            $table->string('created_at')->useCurrent()->nullable();
            $table->string('updated_at')->useCurrent()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blockassistant');
    }
};











