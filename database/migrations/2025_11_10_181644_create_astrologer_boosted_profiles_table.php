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
        Schema::create('astrologer_boosted_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('astrologer_id')->nullable();
            $table->string('chat_commission')->nullable();
            $table->string('call_commission')->nullable();
            $table->string('video_call_commission')->nullable();
            $table->string('boosted_datetime')->nullable();
            $table->string('created_at')->useCurrent()->nullable();
            $table->string('updated_at')->useCurrent()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('astrologer_boosted_profiles');
    }
};











