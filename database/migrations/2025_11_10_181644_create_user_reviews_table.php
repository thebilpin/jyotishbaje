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
        Schema::create('user_reviews', function (Blueprint $table) {
            $table->id();
            $table->string('userId')->nullable()->nullable();
            $table->string('user_name', 100)->nullable();
            $table->string('rating')->nullable();
            $table->string('review')->nullable();
            $table->string('astrologerId')->nullable()->nullable();
            $table->string('astromallProductId')->nullable();
            $table->string('reply', 100)->nullable();
            $table->string('isActive')->nullable();
            $table->string('isDelete')->nullable();
            $table->string('isPublic')->nullable();
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
        Schema::dropIfExists('user_reviews');
    }
};











