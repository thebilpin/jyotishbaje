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
        Schema::create('dailyhoroscopestatics', function (Blueprint $table) {
            $table->id();
            $table->string('horoscopeSignId')->nullable();
            $table->string('horoscopeDate')->nullable();
            $table->string('luckyTime', 45)->nullable();
            $table->string('luckyColor', 45)->nullable();
            $table->string('luckyNumber', 45)->nullable();
            $table->string('moodday', 45)->nullable();
            $table->string('isActive')->nullable()->default(1);
            $table->string('isDelete')->nullable()->default(0);
            $table->string('created_at')->nullable()->useCurrent();
            $table->string('updated_at')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dailyhoroscopestatics');
    }
};











