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
        Schema::create('call_request_apoinments', function (Blueprint $table) {
            $table->id();
            $table->string('callId')->nullable();
            $table->string('astrologerId')->nullable();
            $table->string('userId')->nullable();
            $table->string('amount', 225)->nullable();
            $table->string('call_duration', 225)->nullable();
            $table->string('call_method', 225)->nullable();
            $table->string('status', 225)->nullable()->default('1');
            $table->string('IsActive', 225)->nullable()->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('call_request_apoinments');
    }
};











