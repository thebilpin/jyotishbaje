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
        Schema::create('aiastrologers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('image')->nullable();
            $table->text('about')->nullable();
            $table->string('astrologerCategoryId')->nullable();
            $table->string('primary_skill')->nullable();
            $table->string('all_skills')->nullable();
            $table->string('chat_charge')->nullable();
            $table->string('chat_charge_usd')->nullable();
            $table->string('experience')->nullable();
            $table->text('system_intruction')->nullable();
            $table->string('slug')->nullable();
            $table->string('type')->nullable();
            $table->string('referral_code', 50)->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });
DB::unprepared(file_get_contents(database_path('sql/aiastrologers.sql')));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aiastrologers');
    }
};











