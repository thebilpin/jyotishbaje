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
        Schema::create('liveastro', function (Blueprint $table) {
            $table->id();
            $table->string('astrologerId')->nullable();
            $table->string('channelName', 45)->nullable();
            $table->longText('token')->nullable();
            $table->string('liveChatToken', 45)->nullable();
            $table->string('isActive')->nullable();
            $table->date('schedule_live_date')->nullable();
            $table->time('schedule_live_time')->nullable();
            $table->string('schedule_live_status', 225)->nullable()->default('0');
            $table->string('stream_method', 30)->nullable();
            $table->string('created_at')->nullable()->useCurrent();
            $table->string('updated_at')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('liveastro');
    }
};











