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
        Schema::create('kundali_matchings', function (Blueprint $table) {
            $table->id();
            $table->string('boyName')->nullable();
            $table->string('boyBirthDate')->nullable();
            $table->string('boyBirthTime')->nullable();
            $table->string('boyBirthPlace')->nullable();
            $table->string('girlName')->nullable();
            $table->string('girlBirthDate')->nullable();
            $table->string('girlBirthTime')->nullable();
            $table->string('girlBirthPlace')->nullable();
            $table->string('isActive')->nullable();
            $table->string('isDelete')->nullable();
            $table->timestamps();
            $table->string('createdBy')->nullable();
            $table->string('modifiedBy')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kundali_matchings');
    }
};











