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
        Schema::create('user_chat_histories', function (Blueprint $table) {
            $table->id();
            $table->string('userId')->nullable();
            $table->string('astrologerId')->nullable();
            $table->string('chatStatus')->nullable();
            $table->string('deductionAmount')->nullable();
            $table->string('chatDuration')->nullable();
            $table->string('chatType')->nullable();
            $table->string('chatHistoryNumber')->nullable();
            $table->string('name')->nullable();
            $table->string('birthDate')->nullable();
            $table->string('birthPlace')->nullable();
            $table->string('birthTime')->nullable();
            $table->string('gender')->nullable();
            $table->string('isActive')->nullable();
            $table->string('isDelete')->nullable();
            $table->timestamps();
            $table->string('createdBy')->nullable();
            $table->string('modifiedBy')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_chat_histories');
    }
};











