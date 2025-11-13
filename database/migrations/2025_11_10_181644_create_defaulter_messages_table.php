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
        Schema::create('defaulter_messages', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('type', 20)->nullable();
            $table->string('message', 1000)->nullable();
            $table->string('sender_id', 20)->nullable();
            $table->string('sender_type', 100)->nullable();
            $table->string('receiver_id', 20)->nullable();
            $table->string('receiver_type', 100)->nullable();
            $table->timestamp('updated_at')->nullable()->useCurrent();
            $table->timestamp('created_at')->nullable()->useCurrent();
        });
DB::unprepared(file_get_contents(database_path('sql/defaulter_messages.sql')));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('defaulter_messages');
    }
};











