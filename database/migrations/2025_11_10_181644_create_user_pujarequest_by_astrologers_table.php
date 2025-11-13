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
        Schema::create('user_pujarequest_by_astrologers', function (Blueprint $table) {
            $table->id();
            $table->string('puja_id')->nullable();
            $table->string('astrologerId')->nullable();
            $table->string('userId')->nullable();
            $table->string('puja_start_datetime')->nullable();
            $table->string('puja_end_datetime')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_pujarequest_by_astrologers');
    }
};











