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
        Schema::create('horoscopes', function (Blueprint $table) {
            $table->id();
            $table->string('zodiac')->nullable();
            $table->string('total_score')->nullable();
            $table->string('lucky_color')->nullable();
            $table->string('lucky_color_code')->nullable();
            $table->longText('lucky_number')->nullable();
            $table->string('physique')->nullable();
            $table->string('status')->nullable();
            $table->string('finances')->nullable();
            $table->string('relationship')->nullable();
            $table->string('career')->nullable();
            $table->string('travel')->nullable();
            $table->string('family')->nullable();
            $table->string('friends')->nullable();
            $table->string('health')->nullable();
            $table->text('bot_response')->nullable();
            $table->timestamps();
            $table->date('date')->nullable();
            $table->string('type')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('month_range', 100)->nullable();
            $table->text('health_remark')->nullable();
            $table->text('career_remark')->nullable();
            $table->text('relationship_remark')->nullable();
            $table->text('travel_remark')->nullable();
            $table->text('family_remark')->nullable();
            $table->text('friends_remark')->nullable();
            $table->text('finances_remark')->nullable();
            $table->text('status_remark')->nullable();
            $table->string('langcode', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horoscopes');
    }
};











