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
        Schema::create('astrologer_product', function (Blueprint $table) {
            $table->id();
            $table->string('productId')->nullable();
            $table->string('astrologerId')->nullable();
            $table->decimal('productPrice', 10)->nullable();
            $table->string('isActive')->nullable()->default(1);
            $table->string('isDelete')->nullable()->default(0);
            $table->string('created_at')->nullable()->useCurrent();
            $table->string('updated_at')->nullable()->useCurrent();
            $table->string('createdBy')->nullable();
            $table->string('modifiedBy')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('astrologer_product');
    }
};











