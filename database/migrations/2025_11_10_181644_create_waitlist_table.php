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
        Schema::create('waitlist', function (Blueprint $table) {
            $table->id();
            $table->string('userName', 45)->nullable();
            $table->string('profile', 400)->nullable();
            $table->string('time', 45)->nullable();
            $table->string('channelName', 45)->nullable();
            $table->string('requestType', 45)->nullable();
            $table->string('created_at')->nullable()->useCurrent();
            $table->string('updated_at')->nullable()->useCurrent();
            $table->string('status', 45)->nullable();
            $table->string('userId')->nullable();
            $table->string('userFcmToken', 400)->nullable();
            $table->string('astrologerId')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('waitlist');
    }
};











