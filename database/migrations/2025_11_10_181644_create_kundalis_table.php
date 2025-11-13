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
        Schema::create('kundalis', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('gender')->nullable();
            $table->date('birthDate')->nullable();
            $table->time('birthTime')->nullable();
            $table->string('birthPlace')->nullable();
            $table->string('isActive')->nullable();
            $table->string('isDelete')->nullable();
            $table->timestamps();
            $table->string('createdBy')->nullable();
            $table->string('modifiedBy')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('timezone', 45)->nullable();
            $table->string('isForTrackPlanet')->nullable();
            $table->string('pdf_type')->default('')->nullable();
            $table->string('match_type')->default('')->nullable();
            $table->string('forMatch', 10)->default('0')->nullable();
            $table->text('pdf_link')->nullable();
            $table->string('is_generated')->default(0)->nullable();
            $table->string('response_link')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kundalis');
    }
};











