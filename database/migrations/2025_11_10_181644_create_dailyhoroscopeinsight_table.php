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
        Schema::create('dailyhoroscopeinsight', function (Blueprint $table) {
            $table->id();
            $table->string('name', 400)->nullable();
            $table->string('coverImage', 400)->nullable();
            $table->string('title', 400)->nullable();
            $table->longText('description')->nullable();
            $table->string('horoscopeSignId')->nullable();
            $table->string('horoscopeDate')->nullable();
            $table->string('created_at')->useCurrent()->nullable();
            $table->string('updated_at')->useCurrent()->nullable();
            $table->string('link', 45)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dailyhoroscopeinsight');
    }
};











