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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('helpSupportId')->nullable();
            $table->string('subject')->nullable();
            $table->string('description')->nullable();
            $table->string('ticketNumber')->nullable();
            $table->string('userId')->nullable();
            $table->string('isActive')->nullable();
            $table->string('isDelete')->nullable();
            $table->timestamps();
            $table->string('createdBy')->nullable();
            $table->string('modifiedBy')->nullable();
            $table->string('chatId', 45)->nullable();
            $table->string('ticketStatus', 45)->nullable();
            $table->enum('sender_type', ['Astrologer', 'User'])->default('User');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};











