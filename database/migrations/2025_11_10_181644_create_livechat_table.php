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
        Schema::create('livechat', function (Blueprint $table) {
            $table->id();
            $table->string('userId', 45)->nullable();
            $table->string('partnerId', 45)->nullable();
            $table->string('chatId', 45)->nullable();
            $table->string('created_at')->nullable()->useCurrent();
            $table->string('updated_at')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livechat');
    }
};











