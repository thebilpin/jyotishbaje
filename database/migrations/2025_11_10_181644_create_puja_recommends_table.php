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
        Schema::create('puja_recommends', function (Blueprint $table) {
            $table->id();
            $table->string('puja_id')->nullable();
            $table->string('package_id')->nullable();
            $table->timestamp('recommDateTime')->nullable();
            $table->string('userId')->nullable();
            $table->string('astrologerId')->nullable();
            $table->enum('isPurchased', ['0', '1'])->default('0');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('puja_recommends');
    }
};











