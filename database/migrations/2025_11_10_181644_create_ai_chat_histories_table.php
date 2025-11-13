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
        Schema::create('ai_chat_histories', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('ai_astrologer_id')->nullable();
            $table->string('chat_min')->nullable();
            $table->string('chat_rate')->nullable();
            $table->string('inr_usd_conversion_rate')->default(1)->nullable();
            $table->string('deduction')->nullable();
            $table->string('chat_duration')->nullable();
            $table->string('is_free')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ai_chat_histories');
    }
};











