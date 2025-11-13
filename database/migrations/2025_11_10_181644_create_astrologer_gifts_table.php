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
        Schema::create('astrologer_gifts', function (Blueprint $table) {
            $table->id();
            $table->string('astrologerId')->nullable();
            $table->string('userId')->nullable();
            $table->string('inr_usd_conversion_rate')->default(1)->nullable();
            $table->string('giftId')->nullable();
            $table->decimal('giftAmount', 10)->nullable();
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
        Schema::dropIfExists('astrologer_gifts');
    }
};











