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
        Schema::create('order_request', function (Blueprint $table) {
            $table->id();
            $table->string('userId')->nullable();
            $table->string('astrologerId')->nullable();
            $table->string('aiAstrologerId')->nullable();
            $table->string('orderType', 45)->nullable();
            $table->string('pro_recommend_id')->nullable();
            $table->string('course_id')->nullable();
            $table->string('puja_id')->nullable();
            $table->string('package_id')->nullable();
            $table->string('productCategoryId')->nullable();
            $table->string('productId')->nullable();
            $table->string('orderAddressId')->nullable();
            $table->string('inr_usd_conversion_rate')->default(1)->nullable();
            $table->float('payableAmount')->nullable();
            $table->string('walletBalanceDeducted')->nullable();
            $table->string('gstPercent')->nullable();
            $table->string('totalPayable')->nullable();
            $table->string('couponCode', 45)->nullable();
            $table->string('paymentMethod', 45)->nullable();
            $table->string('orderStatus', 45)->nullable();
            $table->string('totalMin', 45)->nullable();
            $table->string('isActive', 45)->nullable()->default('1');
            $table->string('isDelete', 45)->nullable()->default('0');
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent();
            $table->string('chatId')->nullable();
            $table->string('callId')->nullable();
            $table->string('giftId')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_request');
    }
};











