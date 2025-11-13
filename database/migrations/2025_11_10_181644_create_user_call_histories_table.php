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
        Schema::create('user_call_histories', function (Blueprint $table) {
            $table->id();
            $table->string('callHistoryNumber')->nullable();
            $table->string('userId')->nullable();
            $table->string('astrologerId')->nullable();
            $table->string('callStatus')->nullable();
            $table->string('deductionAmount')->nullable();
            $table->string('callDuration')->nullable();
            $table->string('callType')->nullable();
            $table->string('isIncoming')->nullable();
            $table->string('callAudioFile')->nullable();
            $table->string('name')->nullable();
            $table->string('gender')->nullable();
            $table->string('birthDate')->nullable();
            $table->string('birthTime')->nullable();
            $table->string('birthPlace')->nullable();
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
        Schema::dropIfExists('user_call_histories');
    }
};











