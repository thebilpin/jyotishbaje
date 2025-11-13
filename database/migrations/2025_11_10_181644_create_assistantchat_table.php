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
        Schema::create('assistantchat', function (Blueprint $table) {
            $table->id();
            $table->string('senderId')->nullable();
            $table->string('receiverId')->nullable();
            $table->string('chatId', 20)->nullable();
            $table->string('created_at')->useCurrent()->nullable();
            $table->string('updated_at')->useCurrent()->nullable();
            $table->string('astrologerId')->nullable();
            $table->string('customerId')->nullable();
        });
DB::unprepared(file_get_contents(database_path('sql/assistantchat.sql')));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assistantchat');
    }
};











