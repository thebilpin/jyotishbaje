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
        Schema::create('dailyhoroscope', function (Blueprint $table) {
            $table->id();
            $table->string('category', 100)->nullable();
            $table->longText('description')->nullable();
            $table->string('percentage')->nullable();
            $table->string('horoscopeSignId')->nullable();
            $table->string('horoscopeDate')->nullable();
            $table->string('created_at')->useCurrent()->nullable();
            $table->string('updated_at')->useCurrent()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dailyhoroscope');
    }
};











