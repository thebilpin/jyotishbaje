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
        Schema::create('astrologer_profile_boosts', function (Blueprint $table) {
            $table->id();
            $table->string('chat_commission')->nullable();
            $table->string('call_commission')->nullable();
            $table->string('video_call_commission')->nullable();
            $table->text('profile_boost_benefits')->nullable();
            $table->string('profile_boost')->nullable();
            $table->string('created_at')->useCurrent()->nullable();
            $table->string('updated_at')->useCurrent()->nullable();
        });
DB::unprepared(file_get_contents(database_path('sql/astrologer_profile_boosts.sql')));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('astrologer_profile_boosts');
    }
};











