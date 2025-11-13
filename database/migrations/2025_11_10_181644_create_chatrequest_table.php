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
        Schema::create('chatrequest', function (Blueprint $table) {
            $table->id();
            $table->string('userId')->nullable();
            $table->string('astrologerId')->nullable();
            $table->string('chatStatus', 45)->nullable();
            $table->string('channelName', 45)->nullable();
            $table->string('senderId', 45)->nullable();
            $table->string('receiverId', 45)->nullable();
            $table->string('inr_usd_conversion_rate')->default(1)->nullable();
            $table->string('inr_to_coin_conversion')->default(0)->nullable();
            $table->string('deduction')->nullable();
            $table->string('chatId', 400)->nullable();
            $table->string('deductionFromAstrologer')->nullable();
            $table->string('totalMin', 45)->nullable();
            $table->string('chatRate', 45)->nullable();
            $table->string('chat_duration')->nullable();
            $table->string('created_at')->nullable()->useCurrent();
            $table->string('updated_at')->nullable()->useCurrent();
            $table->string('isFreeSession')->nullable();
            $table->string('validated_till')->nullable();
            $table->string('is_emergency')->default(0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chatrequest');
    }
};











